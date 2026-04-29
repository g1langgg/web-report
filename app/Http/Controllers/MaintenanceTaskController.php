<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\MaintenanceTask;
use App\Models\MaintenanceTaskChecklist;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaintenanceTaskController extends Controller
{
    //

    /**
     * Display list of tasks for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = MaintenanceTask::with(['schedule', 'taskChecklists.checklist', 'schedule.teknisi']);

        // Filter based on role
        if ($user->hasRole('teknisi')) {
            // Teknisi only sees their assigned tasks
            $query->whereHas('schedule', function ($q) use ($user) {
                $q->where('teknisi_id', $user->id);
            });
        }
        // Pelapor, Admin, Manager can see all tasks

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date')) {
            $query->whereDate('tanggal_jadwal', $request->date);
        } else {
            // Default: show today's tasks
            $query->whereDate('tanggal_jadwal', '>=', now()->subDays(7))
                ->whereDate('tanggal_jadwal', '<=', now()->addDays(7));
        }

        $tasks = $query->orderBy('tanggal_jadwal', 'desc')
            ->orderBy('status', 'asc')
            ->paginate(15);

        // Stats for dashboard
        $stats = [
            'today_total' => $this->getTodayTasksCount($user),
            'today_pending' => $this->getTodayTasksCount($user, 'pending'),
            'today_ongoing' => $this->getTodayTasksCount($user, 'ongoing'),
            'today_completed' => $this->getTodayTasksCount($user, 'completed'),
            'need_repair' => $this->getTotalByResult($user, 'need_repair'),
            'urgent' => $this->getTotalByResult($user, 'urgent'),
        ];

        return view('maintenance.tasks.index', compact('tasks', 'stats'));
    }

    /**
     * Show the form for completing a task.
     */
    public function show(MaintenanceTask $task)
    {
        $user = Auth::user();

        // Check authorization
        if ($task->schedule->teknisi_id !== $user->id && !$user->hasRole(['admin', 'manager'])) {
            return redirect()->route('maintenance.tasks.index')
                ->with('error', 'Anda tidak memiliki akses ke task ini.');
        }

        $task->load(['schedule.checklists', 'taskChecklists.checklist', 'report']);

        // Initialize task checklists if not exists
        if ($task->taskChecklists->isEmpty() && $task->schedule->checklists->isNotEmpty()) {
            foreach ($task->schedule->checklists as $checklist) {
                MaintenanceTaskChecklist::create([
                    'task_id' => $task->id,
                    'checklist_id' => $checklist->id,
                    'is_checked' => false,
                ]);
            }
            $task->load('taskChecklists.checklist');
        }

        return view('maintenance.tasks.show', compact('task'));
    }

    /**
     * Start working on a task.
     */
    public function start(MaintenanceTask $task)
    {
        $user = Auth::user();

        if ($task->schedule->teknisi_id !== $user->id) {
            return redirect()->route('maintenance.tasks.index')
                ->with('error', 'Anda tidak dapat memulai task ini.');
        }

        if (!$task->isPending()) {
            return redirect()->route('maintenance.tasks.show', $task)
                ->with('error', 'Task sudah dimulai atau selesai.');
        }

        $task->update([
            'status' => 'ongoing',
            'started_at' => now(),
        ]);

        return redirect()->route('maintenance.tasks.show', $task)
            ->with('success', 'Task dimulai! Silakan lengkapi checklist.');
    }

    /**
     * Update checklist item.
     */
    public function updateChecklist(Request $request, MaintenanceTask $task, MaintenanceTaskChecklist $taskChecklist)
    {
        $user = Auth::user();

        if ($task->schedule->teknisi_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'is_checked' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $taskChecklist->update($validated);

        return response()->json([
            'success' => true,
            'progress' => $task->fresh()->getCompletionPercentage(),
        ]);
    }

    /**
     * Complete a task with result.
     */
    public function complete(Request $request, MaintenanceTask $task)
    {
        $user = Auth::user();

        if ($task->schedule->teknisi_id !== $user->id) {
            return redirect()->route('maintenance.tasks.index')
                ->with('error', 'Anda tidak dapat menyelesaikan task ini.');
        }

        $validated = $request->validate([
            'result_status' => 'required|in:normal,need_repair,urgent',
            'notes' => 'required|string|min:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            // For need_repair, additional fields required
            'location_detail' => 'required_if:result_status,need_repair|string|max:255',
            'condition_detail' => 'required_if:result_status,need_repair|string|min:10',
        ]);

        // Check if all required checklists are completed
        $requiredUnchecked = $task->taskChecklists()
            ->whereHas('checklist', function ($q) {
                $q->where('is_required', true);
            })
            ->where('is_checked', false)
            ->count();

        if ($requiredUnchecked > 0) {
            return redirect()->route('maintenance.tasks.show', $task)
                ->with('error', 'Silakan centang semua checklist wajib terlebih dahulu.');
        }

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('maintenance-photos', 'public');
        }

        // Build notes based on result status
        $notes = $validated['notes'];
        if ($validated['result_status'] === 'need_repair') {
            $notes = "Lokasi: {$validated['location_detail']}\nKondisi: {$validated['condition_detail']}\n\nCatatan: {$validated['notes']}";
        }

        // Update task
        $task->update([
            'status' => 'completed',
            'result_status' => $validated['result_status'],
            'notes' => $notes,
            'photo_path' => $photoPath,
            'completed_at' => now(),
        ]);

        // Handle based on result status
        if ($validated['result_status'] === 'normal') {
            return redirect()->route('maintenance.tasks.index')
                ->with('success', 'Task selesai dengan hasil NORMAL. Semua kondisi baik!');
        }

        if ($validated['result_status'] === 'need_repair') {
            // Redirect to tasks index with warning message
            return redirect()->route('maintenance.tasks.index')
                ->with('warning', 'Task selesai dengan hasil PERLU PERBAIKAN. Laporan telah dibuat untuk tindak lanjut.');
        }

        if ($validated['result_status'] === 'urgent') {
            // Auto-create report for urgent issues
            $report = $this->createReportFromTask($task, 'high');

            // Notify admin/manager
            $admins = \App\Models\User::role(['admin', 'manager'])->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => 'URGENT: Perbaikan Maintenance Diperlukan',
                    'message' => "Task maintenance '{$task->schedule->nama_tugas}' memerlukan perbaikan URGENT di {$task->schedule->lokasi}. Laporan #{$report->ticket_number} telah dibuat otomatis.",
                    'type' => 'urgent_maintenance',
                    'laporan_id' => $report->id,
                ]);
            }

            return redirect()->route('maintenance.tasks.index')
                ->with('error', 'URGENT: Laporan otomatis telah dibuat. Segera lakukan perbaikan!');
        }

        return redirect()->route('maintenance.tasks.index')
            ->with('success', 'Task berhasil diselesaikan!');
    }

    /**
     * Create report from maintenance task.
     */
    public function createReport(MaintenanceTask $task)
    {
        $user = Auth::user();

        if ($task->schedule->teknisi_id !== $user->id) {
            return redirect()->route('maintenance.tasks.index')
                ->with('error', 'Anda tidak dapat membuat laporan dari task ini.');
        }

        if ($task->report_id) {
            return redirect()->route('laporan.show', $task->report_id)
                ->with('info', 'Laporan sudah dibuat sebelumnya.');
        }

        $report = $this->createReportFromTask($task, 'medium');

        return redirect()->route('laporan.show', $report->id)
            ->with('success', 'Laporan berhasil dibuat dari hasil maintenance!');
    }

    /**
     * Helper: Create laporan from task.
     */
    private function createReportFromTask(MaintenanceTask $task, string $priority): Laporan
    {
        $schedule = $task->schedule;
        $user = Auth::user();

        $report = Laporan::create([
            'pelapor_id' => $user->id,
            'ticket_number' => 'MTN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
            'report_date' => now(),
            'location' => $schedule->lokasi,
            'description' => "[Maintenance Report] {$schedule->nama_tugas}\n\n{$task->notes}\n\nHasil Pengecekan: {$task->result_status}",
            'status' => 'pending',
            'priority' => $priority,
            'deadline' => $priority === 'high' ? now()->addHours(4) : now()->addHours(24),
        ]);

        // Update task with report reference
        $task->update(['report_id' => $report->id]);

        return $report;
    }

    /**
     * Get today's task count.
     */
    private function getTodayTasksCount($user, ?string $status = null): int
    {
        $query = MaintenanceTask::whereHas('schedule', function ($q) use ($user) {
            $q->where('teknisi_id', $user->id);
        })->whereDate('tanggal_jadwal', today());

        if ($status) {
            $query->where('status', $status);
        }

        return $query->count();
    }

    /**
     * Get total tasks by result status.
     */
    private function getTotalByResult($user, string $resultStatus): int
    {
        return MaintenanceTask::whereHas('schedule', function ($q) use ($user) {
            $q->where('teknisi_id', $user->id);
        })
            ->where('result_status', $resultStatus)
            ->whereMonth('completed_at', now()->month)
            ->count();
    }
}
