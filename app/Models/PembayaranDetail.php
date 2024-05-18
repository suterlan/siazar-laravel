<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembayaran_id',
        'siswa_id',
        'nominal',
    ];

    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

}
