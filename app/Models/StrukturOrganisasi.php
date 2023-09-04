<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
