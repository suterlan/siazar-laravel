<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user', 'dokumen', 'jurusan', 'kelas'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // public function dokumen(){
    //     return $this->belongsTo(Dokumen::class, 'nisn', 'nisn');
    // }
    public function dokumen()
    {
        return $this->hasOne(Dokumen::class, 'nisn', 'nisn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nisn', 'username');
    }

    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'nilai')
            ->withPivot('nilai')
            ->orderByPivot('mapel_id', 'asc');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
