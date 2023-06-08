<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratUndangan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['tanggal_acara', 'waktu'];

    protected $with = ['suratkeluar'];

    public function suratkeluar(){
        return $this->hasOne(SuratKeluar::class, 'no_surat', 'no_surat');
    }
}
