<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'full_name',
        'city_id',
        'phone_number',
        'facebook_account',
        'linked_in_account',
        'behanc_account',
        'profile_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
