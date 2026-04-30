<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Department;
use App\Models\Laporan;
use App\Models\LaporanAttachment;
use App\Models\LaporanHistory;
use App\Models\LaporanProgress;
use App\Models\Notification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Laporan::with(['department', 'pelapor', 'assignment.teknisi']);

        // Role-based filtering
        if ($user->hasRole('pelapor')) {
            $query->where('pelapor_id', $user->id);
        }

        // Search by keyword (ticket number, location, description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by department
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('report_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('report_date', '<=', $request->date_to);
        }

        // Filter by overdue
        if ($request->filled('overdue') && $request->overdue === 'yes') {
            $query->where('is_overdue', true);
        }

        // Filter by pelapor name
        if ($request->filled('pelapor')) {
            $query->whereHas('pelapor', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->pelapor}%");
            });
        }

        $laporans = $query->latest()->paginate(15)->withQueryString();

        // Get departments for filter dropdown
        $departments = Department::where('is_active', true)->get();

        // Get statistics for the view
        $stats = [
            'total' => $query->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'reopened' => (clone $query)->where('status', 'reopened')->count(),
            'progress' => (clone $query)->where('status', 'progress')->count(),
            'done' => (clone $query)->where('status', 'done')->count(),
            'overdue' => (clone $query)->where('is_overdue', true)->count(),
        ];

        return view('laporan.index', compact('laporans', 'departments', 'stats'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        return view('laporan.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'report_date' => 'required|date',
            'priority' => 'required|in:low,medium,high,urgent',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $ticketNumber = 'TKT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        // Calculate deadline based on priority
        $deadline = match($validated['priority']) {
            'low' => now()->addDays(7),
            'medium' => now()->addDays(3),
            'high' => now()->addDays(1),
            'urgent' => now()->addHours(4),
            default => now()->addDays(3),
        };

        $laporan = Laporan::create([
            'pelapor_id' => Auth::id(),
            'ticket_number' => $ticketNumber,
            'status' => 'pending',
            'deadline' => $deadline,
            'priority' => $validated['priority'],
            ...$validated,
        ]);

        // Create history record
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'created',
            'description' => 'Laporan dibuat dengan nomor ' . $ticketNumber,
        ]);

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('laporan-attachments', 'public');
                LaporanAttachment::create([
                    'laporan_id' => $laporan->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'uploaded_by' => 'pelapor',
                ]);
            }

            LaporanHistory::create([
                'laporan_id' => $laporan->id,
                'user_id' => Auth::id(),
                'action' => 'file_uploaded',
                'description' => count($request->file('attachments')) . ' foto dilampirkan',
            ]);
        }

        // Notify all teknisi about new laporan
        $teknisis = \App\Models\User::role('teknisi')->get();
        foreach ($teknisis as $teknisi) {
            Notification::create([
                'user_id' => $teknisi->id,
                'laporan_id' => $laporan->id,
                'title' => 'Laporan Baru',
                'message' => "Laporan baru #{$ticketNumber} dari {$laporan->department->name}",
                'type' => 'new_laporan',
            ]);
        }

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dibuat dengan nomor: ' . $ticketNumber);
    }

    public function show(Laporan $laporan)
    {
        $laporan->load(['department', 'pelapor', 'assignment.teknisi', 'progressUpdates.user']);
        return view('laporan.show', compact('laporan'));
    }

    public function assign(Request $request, Laporan $laporan)
    {
        $request->validate([
            'teknisi_id' => 'required|exists:users,id',
        ]);

        // Allow assign if status is pending OR reopened
        if (!in_array($laporan->status, ['pending', 'reopened'])) {
            return back()->with('error', 'Laporan sudah tidak tersedia');
        }

        $teknisi = \App\Models\User::find($request->teknisi_id);

        Assignment::create([
            'laporan_id' => $laporan->id,
            'teknisi_id' => $request->teknisi_id,
            'assigned_at' => now(),
        ]);

        $oldStatus = $laporan->status;
        $laporan->update(['status' => 'progress']);

        // Create history record
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'assigned',
            'description' => "Laporan diambil oleh {$teknisi->name}",
        ]);

        // Update status history with correct description
        $statusLabel = $oldStatus === 'reopened' ? 'Revisi' : 'Pending';
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'status_changed',
            'old_value' => $oldStatus,
            'new_value' => 'progress',
            'description' => "Status diubah dari {$statusLabel} ke Progress",
        ]);

        // Notify pelapor
        $isRevisi = $oldStatus === 'reopened';
        Notification::create([
            'user_id' => $laporan->pelapor_id,
            'laporan_id' => $laporan->id,
            'title' => $isRevisi ? 'Revisi Sedang Dikerjakan' : 'Laporan Sedang Dikerjakan',
            'message' => "Laporan #{$laporan->ticket_number} " . ($isRevisi ? 'revisi sedang' : 'sedang') . " dikerjakan oleh {$teknisi->name}",
            'type' => 'assigned',
        ]);

        return redirect()->route('laporan.index')
            ->with('success', $isRevisi ? 'Laporan revisi berhasil diambil' : 'Laporan berhasil diambil');
    }

    public function complete(Request $request, Laporan $laporan)
    {
        $request->validate([
            'completion_notes' => 'required|string|min:5',
            'completion_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($laporan->status !== 'progress') {
            return back()->with('error', 'Status laporan tidak valid');
        }

        $assignment = $laporan->assignment;
        
        if (!$assignment || $assignment->teknisi_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        $photoPath = $request->file('completion_photo')->store('completion-photos', 'public');

        $assignment->update([
            'completion_notes' => $request->completion_notes,
            'completion_photo' => $photoPath,
            'completed_at' => now(),
        ]);

        $oldStatus = $laporan->status;
        $laporan->update([
            'status' => 'done',
            'completed_at' => now(),
        ]);

        // Create history record
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'completed',
            'old_value' => $oldStatus,
            'new_value' => 'done',
            'description' => 'Laporan telah diselesaikan',
        ]);

        LaporanAttachment::create([
            'laporan_id' => $laporan->id,
            'file_path' => $photoPath,
            'file_name' => $request->file('completion_photo')->getClientOriginalName(),
            'file_type' => $request->file('completion_photo')->getMimeType(),
            'file_size' => $request->file('completion_photo')->getSize(),
            'uploaded_by' => 'teknisi',
            'description' => 'Foto bukti penyelesaian',
        ]);

        // Notify pelapor
        Notification::create([
            'user_id' => $laporan->pelapor_id,
            'laporan_id' => $laporan->id,
            'title' => 'Laporan Selesai',
            'message' => "Laporan #{$laporan->ticket_number} telah diselesaikan. Silakan berikan feedback.",
            'type' => 'completed',
        ]);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diselesaikan');
    }

    public function updateProgress(Request $request, Laporan $laporan)
    {
        $request->validate([
            'message' => 'required|string|min:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($laporan->status !== 'progress') {
            return back()->with('error', 'Status laporan tidak valid');
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('progress-photos', 'public');
        }

        $laporan->progressUpdates()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'photo_path' => $photoPath,
        ]);

        // Create history record
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'progress_updated',
            'description' => 'Update progres: ' . Str::limit($request->message, 50),
        ]);

        return back()->with('success', 'Progres berhasil diperbarui');
    }

    public function edit(Laporan $laporan)
    {
        if (($laporan->pelapor_id !== Auth::id() && !Auth::user()->hasAnyRole(['admin', 'manager'])) || $laporan->status !== 'pending') {
            return back()->with('error', 'Tidak dapat edit laporan ini');
        }

        $departments = Department::where('is_active', true)->get();
        return view('laporan.edit', compact('laporan', 'departments'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        if (($laporan->pelapor_id !== Auth::id() && !Auth::user()->hasAnyRole(['admin', 'manager'])) || $laporan->status !== 'pending') {
            return back()->with('error', 'Tidak dapat update laporan ini');
        }

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'location' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'report_date' => 'required|date',
        ]);

        $oldData = $laporan->only(array_keys($validated));
        $laporan->update($validated);

        // Create history record
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'updated',
            'description' => 'Data laporan diperbarui',
        ]);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diupdate');
    }

    public function destroy(Laporan $laporan)
    {
        if (($laporan->pelapor_id !== Auth::id() && !Auth::user()->hasAnyRole(['admin', 'manager'])) || $laporan->status !== 'pending') {
            return back()->with('error', 'Tidak dapat hapus laporan ini');
        }

        // Create history before delete
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'description' => "Laporan #{$laporan->ticket_number} dihapus",
        ]);

        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }

    /**
     * Pelapor accepts the completed laporan
     */
    public function accept(Laporan $laporan)
    {
        // Only pelapor can accept
        if ($laporan->pelapor_id !== Auth::id()) {
            return back()->with('error', 'Hanya pelapor yang dapat menerima laporan');
        }

        // Can only accept if status is done
        if ($laporan->status !== 'done') {
            return back()->with('error', 'Laporan belum selesai dikerjakan');
        }

        // Already accepted
        if ($laporan->is_accepted) {
            return back()->with('error', 'Laporan sudah diterima sebelumnya');
        }

        $laporan->update([
            'is_accepted' => true,
            'accepted_at' => now(),
        ]);

        // Mark any pending revisions as resolved
        $laporan->revisions()->whereNull('resolved_at')->update([
            'resolved_at' => now(),
        ]);

        // Create history
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'accepted',
            'old_value' => 'done',
            'new_value' => 'accepted',
            'description' => 'Laporan diterima dan selesai permanen',
        ]);

        // Notify teknisi
        if ($laporan->assignment?->teknisi) {
            Notification::create([
                'user_id' => $laporan->assignment->teknisi_id,
                'laporan_id' => $laporan->id,
                'title' => 'Laporan Diterima',
                'message' => "Laporan #{$laporan->ticket_number} telah diterima oleh pelapor.",
                'type' => 'completed',
            ]);
        }

        return back()->with('success', 'Laporan berhasil diterima. Terima kasih atas feedback Anda!');
    }

    /**
     * Pelapor requests revision (reopen laporan)
     */
    public function reopen(Request $request, Laporan $laporan)
    {
        // Only pelapor can request revision
        if ($laporan->pelapor_id !== Auth::id()) {
            return back()->with('error', 'Hanya pelapor yang dapat mengajukan revisi');
        }

        // Can only reopen if status is done
        if ($laporan->status !== 'done') {
            return back()->with('error', 'Laporan belum selesai dikerjakan');
        }

        // Check revision limit
        if ($laporan->revisi_count >= 3) {
            return back()->with('error', 'Batas revisi maksimal (3x) sudah tercapai. Laporan akan di-escalate ke supervisor.');
        }

        $validated = $request->validate([
            'alasan' => 'required|string|min:10|max:1000',
            'reassign_teknisi' => 'nullable|boolean',
        ]);

        $newRevisionCount = $laporan->revisi_count + 1;

        // Create revision record
        $revision = $laporan->revisions()->create([
            'pelapor_id' => Auth::id(),
            'teknisi_id' => $request->boolean('reassign_teknisi') ? null : $laporan->assignment?->teknisi_id,
            'revision_number' => $newRevisionCount,
            'alasan' => $validated['alasan'],
            'reopened_at' => now(),
        ]);

        // If reassign, delete current assignment
        if ($request->boolean('reassign_teknisi') && $laporan->assignment) {
            $laporan->assignment->delete();
        }

        // Reopen laporan
        $laporan->update([
            'status' => $request->boolean('reassign_teknisi') ? 'pending' : 'reopened',
            'revisi_count' => $newRevisionCount,
            'completed_at' => null,
        ]);

        // Create history
        LaporanHistory::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'action' => 'reopened',
            'old_value' => 'done',
            'new_value' => $request->boolean('reassign_teknisi') ? 'pending' : 'reopened',
            'description' => "Laporan diajukan revisi (#{$newRevisionCount}): {$validated['alasan']}",
        ]);

        // Notify teknisi (if same teknisi) or all teknisi (if pending)
        if (!$request->boolean('reassign_teknisi') && $laporan->assignment?->teknisi_id) {
            // Notify same teknisi
            Notification::create([
                'user_id' => $laporan->assignment->teknisi_id,
                'laporan_id' => $laporan->id,
                'title' => 'Laporan Perlu Revisi',
                'message' => "Laporan #{$laporan->ticket_number} diajukan revisi. Alasan: " . Str::limit($validated['alasan'], 50),
                'type' => 'reopened',
            ]);
        } else {
            // Notify all teknisi for new assignment
            $teknisiUsers = \App\Models\User::role('teknisi')->get();
            foreach ($teknisiUsers as $teknisi) {
                Notification::create([
                    'user_id' => $teknisi->id,
                    'laporan_id' => $laporan->id,
                    'title' => 'Laporan Tersedia (Revisi)',
                    'message' => "Laporan #{$laporan->ticket_number} membutuhkan teknisi baru untuk revisi.",
                    'type' => 'new_laporan',
                ]);
            }
        }

        // Escalate notification if revision count >= 3
        if ($newRevisionCount >= 3) {
            $admins = \App\Models\User::role(['admin', 'manager'])->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'laporan_id' => $laporan->id,
                    'title' => 'Escalation: Batas Revisi Tercapai',
                    'message' => "Laporan #{$laporan->ticket_number} sudah direvisi {$newRevisionCount}x. Perlu perhatian supervisor.",
                    'type' => 'overdue',
                ]);
            }
        }

        return back()->with('success', 'Revisi berhasil diajukan. Teknisi akan mengerjakan ulang.');
    }

    /**
     * Print Laporan (Berita Acara)
     */
    public function print(Laporan $laporan)
    {
        $laporan->load(['department', 'pelapor', 'assignment.teknisi', 'histories.user', 'comments.user']);
        return view('laporan.print', compact('laporan'));
    }
}
