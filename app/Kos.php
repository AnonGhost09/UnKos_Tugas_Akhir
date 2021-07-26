<?php

namespace App;

use App\Fasilitas;
use App\Kamar;
use App\Pemilik;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $guarded = [];
    //ONE TO MANY KE PEMILIKS
    public function pemiliks()
    {
        return $this->belongsTo(Pemilik::class, 'id_pemilik');
    }

    //ONE TO MANY KE KAMAR
    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'id_kos');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_kos', 'id_kos', 'id_fasilitas');
    }
}
