<?php

namespace App;

use App\Kos;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = ['nama_fasilitas'];

    public function kos()
    {
        return $this->belongsToMany(Kos::class, 'fasilitas_kos', 'id_fasilitas', 'id_kos');
    }
}
