<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceChecklist;
use App\Models\MaintenanceSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    //

    /**
     * Display a listing of maintenance schedules.
     */
    public function index()
    {
        $user = Auth::user();

        // Admin/manager see all, pelapor and teknisi see schedules they created or assigned to them
        if ($user->hasRole(['admin', 'manager'])) {
            $schedules = MaintenanceSchedule::with('teknisi', 'checklists')
                ->latest()
                ->paginate(10);
        } elseif ($user->hasRole('pelapor')) {
            // Pelapor sees all schedules
            $schedules = MaintenanceSchedule::with('teknisi', 'checklists')
                ->latest()
                ->paginate(10);
        } else {
            $schedules = MaintenanceSchedule::with('checklists')
                ->where('teknisi_id', $user->id)
                ->latest()
                ->paginate(10);
        }

        // Stats
        $stats = [
            'total' => $schedules->total(),
            'daily' => MaintenanceSchedule::where('frekuensi', 'daily')->count(),
            'weekly' => MaintenanceSchedule::where('frekuensi', 'weekly')->count(),
            'monthly' => MaintenanceSchedule::where('frekuensi', 'monthly')->count(),
            'active' => MaintenanceSchedule::where('is_active', true)->count(),
        ];

        return view('maintenance.schedules.index', compact('schedules', 'stats'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create()
    {
        $user = Auth::user();

        // Only admin/manager/pelapor can create schedules
        if (!$user->hasRole(['admin', 'manager', 'pelapor'])) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses untuk membuat jadwal maintenance.');
        }

        $teknisis = User::role('teknisi')->get();
        return view('maintenance.schedules.create', compact('teknisis'));
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->hasRole(['admin', 'manager', 'pelapor'])) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses untuk membuat jadwal maintenance.');
        }

        $validated = $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'frekuensi' => 'required|in:daily,weekly,monthly',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'teknisi_id' => 'required|exists:users,id',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $schedule = MaintenanceSchedule::create($validated);

        // Handle checklists
        if ($request->has('checklists')) {
            foreach ($request->checklists as $index => $checklist) {
                if (!empty($checklist['item_name'])) {
                    MaintenanceChecklist::create([
                        'schedule_id' => $schedule->id,
                        'item_name' => $checklist['item_name'],
                        'deskripsi' => $checklist['deskripsi'] ?? null,
                        'urutan' => $index,
                        'is_required' => $checklist['is_required'] ?? true,
                    ]);
                }
            }
        }

        return redirect()->route('maintenance.schedules.index')
            ->with('success', 'Jadwal maintenance berhasil dibuat!');
    }

    /**
     * Display the specified schedule.
     */
    public function show(MaintenanceSchedule $schedule)
    {
        $user = Auth::user();

        // Check authorization
        if (!$user->hasRole(['admin', 'manager']) && $schedule->teknisi_id !== $user->id) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses melihat jadwal ini.');
        }

        $schedule->load(['teknisi', 'checklists', 'tasks' => function ($query) {
            $query->latest()->limit(10);
        }]);

        return view('maintenance.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit(MaintenanceSchedule $schedule)
    {
        $user = Auth::user();

        // Only admin/manager/pelapor can edit schedules
        if (!$user->hasRole(['admin', 'manager', 'pelapor'])) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit jadwal maintenance.');
        }

        $schedule->load('checklists');
        $teknisis = User::role('teknisi')->get();

        return view('maintenance.schedules.edit', compact('schedule', 'teknisis'));
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, MaintenanceSchedule $schedule)
    {
        $user = Auth::user();

        if (!$user->hasRole(['admin', 'manager', 'pelapor'])) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate jadwal maintenance.');
        }

        $validated = $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'frekuensi' => 'required|in:daily,weekly,monthly',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'teknisi_id' => 'required|exists:users,id',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $schedule->update($validated);

        // Update checklists - delete old ones and create new
        if ($request->has('checklists')) {
            $schedule->checklists()->delete();
            foreach ($request->checklists as $index => $checklist) {
                if (!empty($checklist['item_name'])) {
                    MaintenanceChecklist::create([
                        'schedule_id' => $schedule->id,
                        'item_name' => $checklist['item_name'],
                        'deskripsi' => $checklist['deskripsi'] ?? null,
                        'urutan' => $index,
                        'is_required' => $checklist['is_required'] ?? true,
                    ]);
                }
            }
        }

        return redirect()->route('maintenance.schedules.index')
            ->with('success', 'Jadwal maintenance berhasil diupdate!');
    }

    /**
     * Remove the specified schedule.
     */
    public function destroy(MaintenanceSchedule $schedule)
    {
        $user = Auth::user();

        if (!$user->hasRole(['admin', 'manager', 'pelapor'])) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus jadwal maintenance.');
        }

        $schedule->delete();

        return redirect()->route('maintenance.schedules.index')
            ->with('success', 'Jadwal maintenance berhasil dihapus!');
    }

    /**
     * Generate tasks manually from schedules.
     */
    public function generateTasks()
    {
        $user = Auth::user();

        if (!$user->hasRole(['admin', 'manager', 'pelapor'])) {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Anda tidak memiliki akses untuk generate task.');
        }

        // Run the artisan command programmatically
        $exitCode = \Artisan::call('maintenance:generate-tasks');

        if ($exitCode === 0) {
            return redirect()->route('maintenance.schedules.index')
                ->with('success', 'Task maintenance berhasil digenerate! Silakan cek halaman Task.');
        } else {
            return redirect()->route('maintenance.schedules.index')
                ->with('error', 'Gagal generate task. Silakan coba lagi.');
        }
    }
}
