<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'schedule_id',
        'tanggal_jadwal',
        'status',
        'result_status',
        'notes',
        'report_id',
        'started_at',
        'completed_at',
        'photo_path',
    ];

    protected $casts = [
        'tanggal_jadwal' => 'date',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(MaintenanceSchedule::class, 'schedule_id');
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'report_id');
    }

    public function taskChecklists(): HasMany
    {
        return $this->hasMany(MaintenanceTaskChecklist::class, 'task_id');
    }

    public function checklists(): BelongsToMany
    {
        return $this->belongsToMany(MaintenanceChecklist::class, 'maintenance_task_checklists', 'task_id', 'checklist_id')
            ->withPivot('is_checked', 'notes')
            ->withTimestamps();
    }

    // Helper methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isMissed(): bool
    {
        return $this->status === 'missed';
    }

    public function isNormal(): bool
    {
        return $this->result_status === 'normal';
    }

    public function needsRepair(): bool
    {
        return $this->result_status === 'need_repair';
    }

    public function isUrgent(): bool
    {
        return $this->result_status === 'urgent';
    }

    public function allChecklistsCompleted(): bool
    {
        $total = $this->taskChecklists()->count();
        $completed = $this->taskChecklists()->where('is_checked', true)->count();
        return $total > 0 && $total === $completed;
    }

    public function getCompletionPercentage(): int
    {
        $total = $this->taskChecklists()->count();
        if ($total === 0) return 0;
        $completed = $this->taskChecklists()->where('is_checked', true)->count();
        return (int) round(($completed / $total) * 100);
    }
}
