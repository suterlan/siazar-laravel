<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }


        // Rubah tampilan format tanggal surat secara global
    // public function getTanggalSuratAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_surat'])
    //         ->translatedFormat('d/m/Y');
    // }
        // Rubah tampilan format tanggal diterima secara global
    // public function getTanggalDiterimaAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_diterima'])
    //         ->translatedFormat('d/m/Y');
    // }
}
