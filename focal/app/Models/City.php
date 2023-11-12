<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function job()
    {
        return $this->hasMany(Job::class,'city_id');
    }
    public function infoUser(){
        return $this->hasMany(Info_user::class,'city_id');
    }

}
