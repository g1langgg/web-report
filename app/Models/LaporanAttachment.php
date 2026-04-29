<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanAttachment extends Model
{
    protected $fillable = [
        'laporan_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'uploaded_by',
        'description',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class);
    }
}
