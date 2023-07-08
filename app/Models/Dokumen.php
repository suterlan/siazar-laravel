<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa(){
        return $this->hasOne(Siswa::class, 'nis', 'nis');
    }

    public function guru(){
        return $this->hasOne(Guru::class, 'nik', 'nik');
    }
}
