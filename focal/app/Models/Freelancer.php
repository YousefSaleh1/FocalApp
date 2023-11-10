<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
        
    ];



       //This relation, Links the created job, with it's BusinessOwner.
       public function User(){

        return $this->belongsTo('User::class','user_id');
    }


}
