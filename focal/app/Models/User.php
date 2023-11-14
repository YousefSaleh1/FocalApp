<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use newrelic\DistributedTracePayload;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Complain;

use App\Models\BusinessOwner;
use App\Models\Freelancer;
use App\Models\Answer;
use App\Models\JobSeeker;


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

        return $this->hasMany(Answer::class, 'user_id');
    }

    //This relation, Links the BusinessOwner in user table, with the BusinessOwner table.
    public function BusinessOwner() {

        return $this->hasOne(BusinessOwner::class, 'user_id');
    }

    //This relation, Links the Freelancer in user table, with the Freelancer table.
    public function Freelancer() {

        return $this->hasOne(Freelancer::class, 'user_id');
    }

    //This relation, Links the JopSeeker in user table, with the JopSeeker table.
    public function JobSeeker() {

        return $this->hasOne(JobSeeker::class, 'user_id');
    }


    public function user_info()
    {
        return $this->hasOne(User_info::class);
    }

    public function complains()
    {
        return $this->hasMany(Complain::class,'user_id','id');
    }
    public function blogger(){
        return $this->hasOne(Blogger::class,'user_id');
    }

    public function wallet(){
        return $this->hasOne(Wallet::class,'user_id');
    }

}
