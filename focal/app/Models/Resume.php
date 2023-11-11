<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
              'id',
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
