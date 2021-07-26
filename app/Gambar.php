<?php

namespace App;

use App\Kamar;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $guarded = [];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_gambar');
    }
}
