<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

     protected $fillable = [
        'nama',
        'nominal',
        'keterangan'
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pembayaran_kelas')
                    ->withPivot('kelas_id');
    }

    public function details(){
        return $this->hasMany(PembayaranDetail::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

}
