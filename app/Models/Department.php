<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name', 'code', 'description', 'is_active'];

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
