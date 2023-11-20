<?php

namespace App\Models;

use App\Models\JobSeeker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'job_seeker_id',
        'certificates_training_courses',
        'experience',
        'skills',
        'languages',
    ];
    public function JobSeeker()
    {
    return $this->belongsTo(JobSeeker::class,'job_seeker_id');
    }
}