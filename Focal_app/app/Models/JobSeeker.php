<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class JobSeeker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'user_id',
        'job_title',
        'address',
        'Date_of_birth',
        'gender',
        'field_of_work',
        'job_level',
        'experience',
        'work_type',
        'education_level',
        'current_Job_Status',
        'salary_range',
    ];

    //This relation, Links the job Seeker, with it's own user information.
    public function User()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function resume()
    {
        return $this->HasOne(Resume::class);
    }
}
