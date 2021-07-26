<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    //MANY TO MANY KE USER
    public function users(){
        return $this->belongsToMany(User::class,'role_user', 'id_role', 'id_user');
    }
}
