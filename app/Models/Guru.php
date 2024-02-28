<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user', 'dokumen'];

    public function user(){
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function dokumen(){
        return $this->hasOne(Dokumen::class, 'nik', 'nik');
    }

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }

    public function mengajars(){
        return $this->hasMany(Mengajar::class);
    }

    // public function mapels(){
    //     return $this->belongsToMany(Mapel::class, 'mengajars')
    //             ->withPivot('jam', 'tahun_ajaran');
    // }

    // public function kelas(){
    //     return $this->belongsToMany(Kelas::class, 'mengajars')
    //             ->withPivot('jam', 'tahun_ajaran');
    // }

}
