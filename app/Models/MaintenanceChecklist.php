<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MaintenanceChecklist extends Model
{
    protected $fillable = [
        'schedule_id',
        'item_name',
        'deskripsi',
        'urutan',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'urutan' => 'integer',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(MaintenanceSchedule::class, 'schedule_id');
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(MaintenanceTask::class, 'maintenance_task_checklists', 'checklist_id', 'task_id')
            ->withPivot('is_checked', 'notes')
            ->withTimestamps();
    }
}
