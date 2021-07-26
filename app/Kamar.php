<?php

namespace App;

use App\Gambar;
use App\Kos;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $guarded = [];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    public function gambars()
    {
        return $this->hasMany(Gambar::class, 'id_kamar');
    }
}
