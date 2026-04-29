<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin') || $user->hasRole('manager')) {
            return $this->adminDashboard();
        }

        if ($user->hasRole('teknisi')) {
            return $this->teknisiDashboard();
        }

        return $this->pelaporDashboard();
    }

    private function adminDashboard()
    {
        // Basic stats
        $stats = [
            'pending' => Laporan::where('status', 'pending')->count(),
            'progress' => Laporan::where('status', 'progress')->count(),
            'done' => Laporan::where('status', 'done')->count(),
            'overdue' => Laporan::where('is_overdue', true)->count(),
            'total' => Laporan::count(),
        ];

        // Time-based stats
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();

        $timeStats = [
            'today' => [
                'created' => Laporan::whereDate('created_at', $today)->count(),
                'completed' => Laporan::whereDate('completed_at', $today)->where('status', 'done')->count(),
                'pending_change' => Laporan::where('status', 'pending')->whereDate('created_at', $today)->count(),
                'progress_change' => Laporan::where('status', 'progress')->whereDate('updated_at', $today)->count(),
                'done_change' => Laporan::where('status', 'done')->whereDate('completed_at', $today)->count(),
            ],
            'yesterday' => [
                'created' => Laporan::whereDate('created_at', $yesterday)->count(),
            ],
            'this_week' => [
                'created' => Laporan::whereBetween('created_at', [$weekStart, Carbon::now()])->count(),
                'completed' => Laporan::whereBetween('completed_at', [$weekStart, Carbon::now()])->where('status', 'done')->count(),
            ],
            'this_month' => [
                'created' => Laporan::whereBetween('created_at', [$monthStart, Carbon::now()])->count(),
                'completed' => Laporan::whereBetween('completed_at', [$monthStart, Carbon::now()])->where('status', 'done')->count(),
            ],
        ];

        // Chart data - Last 7 days
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartData['labels'][] = $date->format('d M');
            $chartData['created'][] = Laporan::whereDate('created_at', $date)->count();
            $chartData['completed'][] = Laporan::whereDate('completed_at', $date)->where('status', 'done')->count();
        }

        // Monthly chart data
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyData['labels'][] = $month->format('M Y');
            $monthlyData['created'][] = Laporan::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
            $monthlyData['completed'][] = Laporan::whereYear('completed_at', $month->year)->whereMonth('completed_at', $month->month)->where('status', 'done')->count();
        }

        // Top technicians
        $topTeknisi = User::role('teknisi')
            ->withCount(['assignments as completed_count' => function($q) {
                $q->whereNotNull('completed_at');
            }])
            ->orderByDesc('completed_count')
            ->take(5)
            ->get();

        // Department stats
        $departmentStats = Laporan::selectRaw('department_id, COUNT(*) as count')
            ->groupBy('department_id')
            ->with('department')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Priority distribution
        $priorityStats = [
            'low' => Laporan::where('priority', 'low')->count(),
            'medium' => Laporan::where('priority', 'medium')->count(),
            'high' => Laporan::where('priority', 'high')->count(),
            'urgent' => Laporan::where('priority', 'urgent')->count(),
        ];

        $recentLaporans = Laporan::with(['department', 'pelapor', 'assignment.teknisi'])
            ->latest()
            ->take(10)
            ->get();

        // Maintenance stats for admin
        $maintenanceStats = [
            'today_total' => \App\Models\MaintenanceTask::whereDate('tanggal_jadwal', today())->count(),
            'today_pending' => \App\Models\MaintenanceTask::whereDate('tanggal_jadwal', today())->where('status', 'pending')->count(),
            'today_ongoing' => \App\Models\MaintenanceTask::whereDate('tanggal_jadwal', today())->where('status', 'ongoing')->count(),
            'today_completed' => \App\Models\MaintenanceTask::whereDate('tanggal_jadwal', today())->where('status', 'completed')->count(),
            'need_repair' => \App\Models\MaintenanceTask::where('result_status', 'need_repair')->whereMonth('completed_at', now()->month)->count(),
            'urgent' => \App\Models\MaintenanceTask::where('result_status', 'urgent')->whereMonth('completed_at', now()->month)->count(),
        ];

        // Today's maintenance tasks
        $todayMaintenanceTasks = \App\Models\MaintenanceTask::with(['schedule', 'schedule.teknisi'])
            ->whereDate('tanggal_jadwal', today())
            ->orderBy('status', 'asc')
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'stats', 'timeStats', 'chartData', 'monthlyData',
            'topTeknisi', 'departmentStats', 'priorityStats', 'recentLaporans',
            'maintenanceStats', 'todayMaintenanceTasks'
        ));
    }

    private function teknisiDashboard()
    {
        $user = Auth::user();

        $stats = [
            'available' => Laporan::whereIn('status', ['pending', 'reopened'])->count(),
            'pending' => Laporan::where('status', 'pending')->count(),
            'reopened' => Laporan::where('status', 'reopened')->count(),
            'my_progress' => Assignment::where('teknisi_id', $user->id)
                ->whereNull('completed_at')->count(),
            'my_completed' => Assignment::where('teknisi_id', $user->id)
                ->whereNotNull('completed_at')->count(),
            // Maintenance stats
            'maintenance_today' => \App\Models\MaintenanceTask::whereHas('schedule', function ($q) use ($user) {
                    $q->where('teknisi_id', $user->id);
                })
                ->whereDate('tanggal_jadwal', today())
                ->count(),
            'maintenance_pending' => \App\Models\MaintenanceTask::whereHas('schedule', function ($q) use ($user) {
                    $q->where('teknisi_id', $user->id);
                })
                ->whereDate('tanggal_jadwal', today())
                ->where('status', 'pending')
                ->count(),
            'maintenance_need_repair' => \App\Models\MaintenanceTask::whereHas('schedule', function ($q) use ($user) {
                    $q->where('teknisi_id', $user->id);
                })
                ->where('result_status', 'need_repair')
                ->whereMonth('completed_at', now()->month)
                ->count(),
        ];

        // Chart data for teknisi
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartData['labels'][] = $date->format('d M');
            $chartData['completed'][] = Assignment::where('teknisi_id', $user->id)
                ->whereDate('completed_at', $date)
                ->count();
        }

        $availableLaporans = Laporan::whereIn('status', ['pending', 'reopened'])
            ->with('department')
            ->latest()
            ->take(10)
            ->get();

        $myAssignments = Assignment::where('teknisi_id', $user->id)
            ->with(['laporan.department'])
            ->latest()
            ->take(10)
            ->get();

        // Today's maintenance tasks
        $todayMaintenanceTasks = \App\Models\MaintenanceTask::with('schedule')
            ->whereHas('schedule', function ($q) use ($user) {
                $q->where('teknisi_id', $user->id);
            })
            ->whereDate('tanggal_jadwal', today())
            ->orderBy('status', 'asc')
            ->take(5)
            ->get();

        return view('dashboard.teknisi', compact('stats', 'chartData', 'availableLaporans', 'myAssignments', 'todayMaintenanceTasks'));
    }

    private function pelaporDashboard()
    {
        $user = Auth::user();

        $myLaporans = Laporan::where('pelapor_id', $user->id)
            ->with(['department', 'assignment.teknisi'])
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'pending' => Laporan::where('pelapor_id', $user->id)->where('status', 'pending')->count(),
            'progress' => Laporan::where('pelapor_id', $user->id)->where('status', 'progress')->count(),
            'done' => Laporan::where('pelapor_id', $user->id)->where('status', 'done')->count(),
            'total' => Laporan::where('pelapor_id', $user->id)->count(),
        ];

        // Chart data for pelapor
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartData['labels'][] = $date->format('d M');
            $chartData['created'][] = Laporan::where('pelapor_id', $user->id)
                ->whereDate('created_at', $date)
                ->count();
            $chartData['completed'][] = Laporan::where('pelapor_id', $user->id)
                ->whereDate('completed_at', $date)
                ->where('status', 'done')
                ->count();
        }

        // Time-based stats for trend labels
        $timeStats = [
            'today' => [
                'pending_change' => Laporan::where('pelapor_id', $user->id)->where('status', 'pending')->whereDate('created_at', today())->count(),
                'progress_change' => Laporan::where('pelapor_id', $user->id)->where('status', 'progress')->whereDate('updated_at', today())->count(),
                'done_change' => Laporan::where('pelapor_id', $user->id)->where('status', 'done')->whereDate('completed_at', today())->count(),
            ]
        ];

        // Today's maintenance tasks for pelapor view
        $todayMaintenanceTasks = \App\Models\MaintenanceTask::with('schedule')
            ->whereDate('tanggal_jadwal', today())
            ->orderBy('status', 'asc')
            ->take(5)
            ->get();

        return view('dashboard.pelapor', compact('stats', 'myLaporans', 'chartData', 'timeStats', 'todayMaintenanceTasks'));
    }
}
