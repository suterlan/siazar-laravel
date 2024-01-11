<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['dokumen_ajar'];

    public function dokumen_ajar(){
        return $this->hasOne(DokumenAjar::class, 'kode', 'kode');
    }

    // public function kelas(){
    //     return $this->belongsToMany(Kelas::class, 'mengajars')
    //             ->withPivot('id', 'jam', 'tahun_ajaran');
    // }

    // public function gurus(){
    //     return $this->belongsToMany(Guru::class, 'mengajars')
    //             ->withPivot('id', 'jam', 'tahun_ajaran');
    // }

    public function mengajars(){
        return $this->hasMany(Mengajar::class);
    }

    public function siswas(){
        return $this->belongsToMany(Siswa::class, 'nilai')
                ->withPivot('nilai')
                ->orderByPivot('mapel_id', 'asc');
    }

}
