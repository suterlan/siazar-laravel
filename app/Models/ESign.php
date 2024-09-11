<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ESign extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'active',
        'no_surat',
    ];

    public function suratkeluar()
    {
        return $this->hasOne(SuratKeluar::class, 'no_surat', 'no_surat');
    }
}
