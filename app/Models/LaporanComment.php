<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanComment extends Model
{
    protected $fillable = [
        'laporan_id',
        'user_id',
        'message',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
