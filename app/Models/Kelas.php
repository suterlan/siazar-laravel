<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jurusan_id',
        'guru_id'
    ];

    protected $with = ['guru', 'jurusan'];

    public function siswas(){
        return $this->hasMany(Siswa::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function mengajars(){
        return $this->hasMany(Mengajar::class);
    }

    public function pembayarans(){
        return $this->belongsToMany(Pembayaran::class, 'pembayaran_kelas');
    }

}
