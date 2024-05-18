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

    public function mengajars(){
        return $this->hasMany(Mengajar::class);
    }

    public function siswas(){
        return $this->belongsToMany(Siswa::class, 'nilai')
            ->withPivot('nilai')
            ->orderByPivot('mapel_id', 'asc');
    }

    public function nilais(){
        return $this->hasMany(Nilai::class);
    }

}
