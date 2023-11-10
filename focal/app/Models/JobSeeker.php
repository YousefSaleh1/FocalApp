<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeeker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
              'id',
            'user_id',
           'job_title',
            'address',
            'Date_of_birth',
             'gender',
             'photo',
             'field_of_work',
            'job_level',
            'experience',
            'work_type',
            'education_level',
            'current_status',
             'salary_range',
             ]
              public function resume()
{
    return $this->HasOne(Resume::class);
}


}


