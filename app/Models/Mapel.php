<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['dokumen_ajar'];

        public function dokumen_ajar(){
            return $this->belongsTo(DokumenAjar::class, 'kode', 'kode');
        }

        public function guru()
        {
            return $this->belongsTo(Guru::class);
        }

        public function mengajars()
        {
            return $this->hasMany(Mengajar::class, 'kode', 'kode_mapel');
        }
}