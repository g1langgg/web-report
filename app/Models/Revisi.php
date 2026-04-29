<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Revisi extends Model
{
    protected $fillable = [
        'laporan_id',
        'pelapor_id',
        'teknisi_id',
        'revision_number',
        'alasan',
        'reopened_at',
        'resolved_at',
    ];

    protected $casts = [
        'reopened_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class);
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
