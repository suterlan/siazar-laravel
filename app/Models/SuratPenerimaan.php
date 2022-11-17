<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPenerimaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function suratkeluar(){
        return $this->hasOne(SuratKeluar::class, 'no_surat', 'no_surat');
    }
}
