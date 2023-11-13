<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'current',
        'point'
    ];


    public function processes(){

        return $this->hasMany(Processes::class,'wallet_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
