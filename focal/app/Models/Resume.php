<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
            'certificates/training_courses',
           'experience',
            'skills',
            'languages',
    ];
     public function JobSeeker()
{
    return $this->belongsTo(JobSeeker::class);
}
}
