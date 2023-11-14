<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable=[
        'city_name',
    ];

    public function job()
    {
        return $this->hasMany(Job::class,'city_id' , 'id');
    }
    public function userinfo(){
        return $this->hasMany(User_info::class,'city_id' ,'id');
    }

}
