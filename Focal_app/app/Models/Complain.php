<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User ;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complain extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable=[
            'user_id',
            'complain_type',
            'complain_reason',
            'photoURL',
            ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
