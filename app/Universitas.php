<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    protected $fillable = ['nama', 'desc_universitas', 'gambar', 'lat', 'lng'];
}
