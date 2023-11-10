<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\BusinessOwner;
use App\Models\Freelancer;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_name',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role_name' => 'array',

    ];

    //This relation, Links the User with their answers, so every User 
    //have many answers.
    public function UserAnswers() {

        return $this->hasMany('Answer::class', 'user_id');
    }

    public function BusinessOwner() {

        return $this->hasOne('BusinessOwner::class', 'user_id');
    }

    public function Freelancer() {

        return $this->hasOne('Freelancer::class', 'user_id');
    }

}
