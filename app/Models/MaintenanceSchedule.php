<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceSchedule extends Model
{
    protected $fillable = [
        'nama_tugas',
        'frekuensi',
        'lokasi',
        'deskripsi',
        'teknisi_id',
        'is_active',
        'waktu_mulai',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'waktu_mulai' => 'datetime',
    ];

    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function checklists(): HasMany
    {
        return $this->hasMany(MaintenanceChecklist::class, 'schedule_id')->orderBy('urutan');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(MaintenanceTask::class, 'schedule_id');
    }
}
