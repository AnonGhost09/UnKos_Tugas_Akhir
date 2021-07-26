<?php

namespace App;

use App\Kamar;
use App\Kos;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $guarded = [];
    //ONE TO ONE KE USER
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    //ONE TO MANY KE KOS
    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_pemilik');
    }

    public function kamars()
    {
        return $this->hasManyThrough(Kamar::class, Kos::class, 'id_pemilik', 'id_kos');
    }
}
