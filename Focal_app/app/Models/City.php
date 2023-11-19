<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'city_name'
    ];

    public function companyjobs()

    {
        return $this->hasMany(CompanyJob::class, 'city_id', 'id');
    }
    public function userinfos()

    {
        return $this->hasMany(UserInfo::class, 'city_id', 'id');
    }
}
