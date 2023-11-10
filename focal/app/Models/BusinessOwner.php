<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessOwner extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_name',
        'company_field',
        'city',
        'company_size',
        'year_founded',
        'company_logo',
        'responsible_job_role',
        'company_number',
        'website',

    ];
}
