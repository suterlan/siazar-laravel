<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'logo'
    ];

    // protected $with = ['kelas'];

    public function siswas(){
        return $this->hasMany(Siswa::class);
    }
    public function ppdbs(){
        return $this->hasMany(PPDB::class);
    }
    public function galeris(){
        return $this->hasMany(Galeri::class);
    }

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }
}
