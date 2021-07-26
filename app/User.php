<?php

namespace App;

use App\Kos;
use App\Pemilik;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'gambar_profil', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //MANY TO MANY KE ROLE
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'id_user', 'id_role');
    }

    public function pemiliks()
    {
        return $this->hasOne(Pemilik::class, 'id_user');
    }

    public function kos()
    {
        return $this->HasManyThrough(Kos::class, Pemilik::class, 'id_user', 'id_pemilik');
    }
}
