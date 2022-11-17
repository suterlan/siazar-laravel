<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function klasifikasi(){
        return $this->belongsTo(Klasifikasi::class);
    }

    public function penerimaan(){
        return $this->belongsTo(SuratPenerimaan::class, 'no_surat', 'no_surat');
    }

     // Rubah tampilan format tanggal surat secara global
    public function getTanggalSuratAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_surat'])
            ->translatedFormat('Y/m/d');
    }
}
