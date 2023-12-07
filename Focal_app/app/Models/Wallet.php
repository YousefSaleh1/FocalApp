<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = [
        'user_id',
        'current',
        'point'
    ];

    public function processe()
    {
        return $this->hasMany(Processes::class, 'walet_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

