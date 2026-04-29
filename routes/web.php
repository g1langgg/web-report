<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceTaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:pelapor')->group(function () {
        Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
        Route::get('/laporan/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
        Route::put('/laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
        Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    });

    Route::middleware('role:teknisi')->group(function () {
        Route::post('/laporan/{laporan}/assign', [LaporanController::class, 'assign'])->name('laporan.assign');
        Route::post('/laporan/{laporan}/complete', [LaporanController::class, 'complete'])->name('laporan.complete');
    });

    // Pelapor accept/revision routes
    Route::post('/laporan/{laporan}/accept', [LaporanController::class, 'accept'])->name('laporan.accept');
    Route::post('/laporan/{laporan}/reopen', [LaporanController::class, 'reopen'])->name('laporan.reopen');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{laporan}/print', [LaporanController::class, 'print'])->name('laporan.print');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');

    // Feedback
    Route::post('/laporan/{laporan}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Comments
    Route::post('/laporan/{laporan}/comments', [\App\Http\Controllers\LaporanCommentController::class, 'store'])->name('laporan.comments.store');

    // Preventive Maintenance System - All authenticated users can access
    Route::middleware(['auth', 'verified'])->prefix('maintenance')->group(function () {
        // Schedules - Pelapor, Admin, Manager can CRUD
        Route::get('/schedules', [MaintenanceController::class, 'index'])->name('maintenance.schedules.index');
        Route::get('/schedules/create', [MaintenanceController::class, 'create'])->name('maintenance.schedules.create');
        Route::post('/schedules', [MaintenanceController::class, 'store'])->name('maintenance.schedules.store');
        Route::get('/schedules/{schedule}', [MaintenanceController::class, 'show'])->name('maintenance.schedules.show');
        Route::get('/schedules/{schedule}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.schedules.edit');
        Route::put('/schedules/{schedule}', [MaintenanceController::class, 'update'])->name('maintenance.schedules.update');
        Route::delete('/schedules/{schedule}', [MaintenanceController::class, 'destroy'])->name('maintenance.schedules.destroy');

        // Generate tasks manually
        Route::post('/schedules/generate-tasks', [MaintenanceController::class, 'generateTasks'])->name('maintenance.schedules.generate-tasks');

        // Tasks - Pelapor can view results, Teknisi can complete
        Route::get('/tasks', [MaintenanceTaskController::class, 'index'])->name('maintenance.tasks.index');
        Route::get('/tasks/{task}', [MaintenanceTaskController::class, 'show'])->name('maintenance.tasks.show');

        // Teknisi only actions
        Route::middleware('role:teknisi')->group(function () {
            Route::post('/tasks/{task}/start', [MaintenanceTaskController::class, 'start'])->name('maintenance.tasks.start');
            Route::post('/tasks/{task}/complete', [MaintenanceTaskController::class, 'complete'])->name('maintenance.tasks.complete');
            Route::post('/tasks/{task}/create-report', [MaintenanceTaskController::class, 'createReport'])->name('maintenance.tasks.create-report');
            Route::post('/tasks/{task}/checklist/{taskChecklist}', [MaintenanceTaskController::class, 'updateChecklist'])->name('maintenance.tasks.update-checklist');
        });
    });
});

require __DIR__.'/auth.php';
