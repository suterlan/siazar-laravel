<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TracingAlumni extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['siswa'];

    function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
