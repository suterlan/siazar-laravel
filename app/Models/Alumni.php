<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'angkatan',
        'siswa_id'
    ];

    function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
