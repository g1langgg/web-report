<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceTaskChecklist extends Model
{
    protected $table = 'maintenance_task_checklists';

    protected $fillable = [
        'task_id',
        'checklist_id',
        'is_checked',
        'notes',
    ];

    protected $casts = [
        'is_checked' => 'boolean',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(MaintenanceTask::class, 'task_id');
    }

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(MaintenanceChecklist::class, 'checklist_id');
    }
}
