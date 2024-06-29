<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'pembayaran_id',
        'siswa_id',
        'iuran',
        'nominal',
        'nama_siswa',
        'status',
        'snap_token',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class);
    }
}
