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
        $validator_data = $request->validated();

        $jobseeker = JobSeeker::create($validator_data);

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

        $validator_data = $request->validated();

        $jobseeker ->update( $validator_data);
        return $this->apiResponse(new JobSeekerResource($jobseeker),"" ,'the jobseeker updated',200);

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
