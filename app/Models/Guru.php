<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user', 'dokumen'];

    public function user(){
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function dokumen(){
        return $this->belongsTo(Dokumen::class, 'nik', 'nik');
    }

    public function mapel(){
        return $this->hasMany(Mapel::class);
    }
}
