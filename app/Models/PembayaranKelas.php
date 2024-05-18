<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembayaran_id',
        'kelas_id',
    ];

    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
