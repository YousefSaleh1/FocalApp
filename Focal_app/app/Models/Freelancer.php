<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];



    //This relation, Links the Freelancer, with it's own user information.
    public function User()
    {

        return $this->belongsTo(User::class, 'user_id');
    }
}
