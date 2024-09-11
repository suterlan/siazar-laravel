<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['klasifikasi'];

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }

    public function penerimaan()
    {
        return $this->belongsTo(SuratPenerimaan::class, 'no_surat', 'no_surat');
    }
    public function mutasi()
    {
        return $this->belongsTo(SuratMutasi::class, 'no_surat', 'no_surat');
    }
    public function panggilan()
    {
        return $this->belongsTo(SuratPanggilan::class, 'no_surat', 'no_surat');
    }
    public function undangan()
    {
        return $this->belongsTo(SuratUndangan::class, 'no_surat', 'no_surat');
    }
    public function umum()
    {
        return $this->belongsTo(SuratUmum::class, 'no_surat', 'no_surat');
    }
    public function custom()
    {
        return $this->belongsTo(SuratCustom::class, 'no_surat', 'no_surat');
    }
    public function skbm()
    {
        return $this->belongsTo(SKBM::class, 'no_surat', 'no_surat');
    }
    public function kelulusan()
    {
        return $this->belongsTo(SuratKelulusan::class, 'no_surat', 'no_surat');
    }

    // Rubah tampilan format tanggal surat secara global
    public function getTanggalSuratAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_surat'])
            ->translatedFormat('Y/m/d');
    }

    public function esign()
    {
        return $this->belongsTo(ESign::class, 'no_surat', 'no_surat');
    }

    public function skPengangkatan()
    {
        return $this->belongsTo(SKPengangkatan::class, 'no_surat', 'no_surat');
    }
}
