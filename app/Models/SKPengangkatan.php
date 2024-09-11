<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKPengangkatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'no_surat',
    ];

    public function skbm()
    {
        return $this->belongsTo(SKBM::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function suratkeluar()
    {
        return $this->hasOne(SuratKeluar::class, 'no_surat', 'no_surat');
    }
}
