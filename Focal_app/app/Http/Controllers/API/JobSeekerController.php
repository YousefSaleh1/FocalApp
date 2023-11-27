<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobSeeker;
use App\Http\Resources\JobSeekerResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\CreateTrait;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    use ApiResponseTrait , CreateTrait;

    public function index()
    {
        $jobseekers = JobSeeker::all();
        return $this->customeRespone(JobSeekerResource::collection($jobseekers),'ok',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreJobSeeker $request)
    {
        $validator_data = $request->validated();
        $user_id = Auth::user()->id;
        $jobseeker = JobSeeker::create([
            'user_id' => $user_id,
            'job_title' => $request->job_title ,
            'address'=> $request->address ,
            'Date_of_birth'=> $request->Date_of_birth ,
            'gender'=> $request->gender ,
            'field_of_work'=> $request->field_of_work ,
            'job_level'=> $request->job_level ,
            'experience'=> $request->experience ,
            'work_type'=> $request->work_type ,
            'education_level'=> $request->education_level ,
            'current_Job_Status'=> $request->current_Job_Status ,
            'salary_range'=> $request->salary_range
        ]);
        $this->CreateWallete($user_id);
        if($jobseeker){
            return $this->customeRespone(new JobSeekerResource($jobseeker),'the jobseeker created successfully',201);
        }
        return $this->customeRespone(null,'the jobseeker not added',400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobseeker = JobSeeker::find($id);
        if(!$jobseeker){
            return $this->customeRespone(null ,'the jobseeker not found',404);
        }
        return $this->customeRespone(new JobSeekerResource($jobseeker),'ok',200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJobSeeker $request, string $id)
    {
        $jobseeker = JobSeeker::find($id);
        if(!$jobseeker){
            return $this->customeRespone(null,'the jobseeker not found',404);
        }

        $validator_data = $request->validated();

        $jobseeker ->update([
            'job_title' => $request->job_title ,
            'address'=> $request->address ,
            'Date_of_birth'=> $request->Date_of_birth ,
            'gender'=> $request->gender ,
            'field_of_work'=> $request->field_of_work ,
            'job_level'=> $request->job_level ,
            'experience'=> $request->experience ,
            'work_type'=> $request->work_type ,
            'education_level'=> $request->education_level ,
            'current_Job_Status'=> $request->current_Job_Status ,
            'salary_range'=> $request->salary_range
        ]);
        return $this->customeRespone(new JobSeekerResource($jobseeker),'the jobseeker updated',200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobseeker = JobSeeker::find($id);
        if(!$jobseeker){
            return $this->customeRespone(null,'the jobseeker not found',404);
        }
        $jobseeker->delete($id);
        return $this->customeRespone("",'the jobseeker deleted',200);
    }
}
