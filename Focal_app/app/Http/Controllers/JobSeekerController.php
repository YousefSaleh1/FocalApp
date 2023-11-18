<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobSeeker;
use App\Http\Resources\JobSeekerResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobSeekerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $jobseekers = JobSeeker::all();
        return $this->apiResponse(JobSeekerResource::collection($jobseekers),"",'ok',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreJobSeeker $request)
    {
        $validator = $request->validated();
            if($validator->fails()){
            return $this ->apiResponse(null, "",$validator->errors(),400);
        }

        $jobseeker=JobSeeker::create([
            'user_id'         => Auth::User()->id ,
            'job_title'       =>$request->job_title,
            'address'         =>$request->address,
            'Date_of_birth'   =>$request->Date_of_birth,
            'gender'          =>$request->gender,
            'field_of_work'   =>$request->field_of_work,
            'job_level'       =>$request->job_level,
            'experience'      => $request->experience,
            'work_type'       => $request-> work_type,
            'education_level' => $request->education_level,
            'current_Job_Status'  => $request->current_Job_Status,
            'salary_range'    => $request->salary_range,
        ]);

        if($jobseeker){
            return $this->apiResponse(new JobSeekerResource($jobseeker), "" ,'the jobseeker created successfully',200);
        }
        return $this->apiResponse(null,"" ,'the jobseeker not added',400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobseeker = JobSeeker::find($id);
        if(!$jobseeker){
            return $this->apiResponse(null,"" ,'the jobseeker not found',404);
        }
        return $this->apiResponse(new JobSeekerResource($jobseeker),"" ,'ok',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJobSeeker $request, string $id)
    {
        $jobseeker = JobSeeker::find($id);
        if(!$jobseeker){
            return $this->apiResponse(null, "",'the jobseeker not found',404);
        }

        $validator = $request->validated();
        if($validator->fails()){
            return $this ->apiResponse(null, "",$validator->errors(),400);
        }

        $job_seeker= $jobseeker ->update([
            'user_id'         => Auth::User()->id ,
            'job_title'       =>$request->job_title,
            'address'         =>$request->address,
            'Date_of_birth'   =>$request->Date_of_birth,
            'gender'          =>$request->gender,
            'field_of_work'   =>$request->field_of_work,
            'job_level'       =>$request->job_level,
            'experience'      => $request->experience,
            'work_type'       => $request-> work_type,
            'education_level' => $request->education_level,
            'current_Job_Status'  => $request->current_Job_Status,
            'salary_range'    => $request->salary_range,
        ]);

        if($job_seeker){
            return $this->apiResponse(new JobSeekerResource($jobseeker),"" ,'the jobseeker updated',200);
        }
        return $this->apiResponse(null,"" ,'the jobseeker not updated',400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobseeker = JobSeeker::find($id);
        if(!$jobseeker){
            return $this->apiResponse(null," " ,'the jobseeker not found',404);
        }
        $jobseeker->delete($id);
        return $this->apiResponse("","" ,'the jobseeker deleted',200);
    }
}
