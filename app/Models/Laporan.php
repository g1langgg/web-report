<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    protected $fillable = [
        'pelapor_id',
        'department_id',
        'ticket_number',
        'report_date',
        'location',
        'description',
        'status',
        'deadline',
        'priority',
        'is_overdue',
        'solution_notes',
        'completed_at',
        'revisi_count',
        'is_accepted',
        'accepted_at',
    ];

    protected $casts = [
        'report_date' => 'date',
        'deadline' => 'datetime',
        'completed_at' => 'datetime',
        'is_overdue' => 'boolean',
        'is_accepted' => 'boolean',
        'accepted_at' => 'datetime',
    ];

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function assignment(): HasOne
    {
        return $this->hasOne(Assignment::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(LaporanAttachment::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(LaporanHistory::class)->orderBy('created_at', 'desc');
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(Revisi::class)->orderBy('revision_number', 'desc');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(LaporanComment::class)->orderBy('created_at', 'asc');
    }

    public function progressUpdates(): HasMany
    {
        return $this->hasMany(LaporanProgress::class)->orderBy('created_at', 'desc');
    }

    public function getStatusBadgeAttribute(): string
    {
        if ($this->is_overdue && $this->status !== 'done') {
            return 'overdue';
        }
        return $this->status;
    }

    public function markAsOverdue(): void
    {
        if ($this->deadline && $this->deadline->isPast() && $this->status !== 'done' && !$this->is_overdue) {
            $this->update(['is_overdue' => true]);
            
            // Create notification for overdue
            Notification::create([
                'user_id' => $this->pelapor_id,
                'laporan_id' => $this->id,
                'title' => 'Laporan Overdue',
                'message' => "Laporan #{$this->ticket_number} telah melewati deadline.",
                'type' => 'overdue',
            ]);
        }
    }
}
