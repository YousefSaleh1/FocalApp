<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeRequest;
use App\Http\Resources\ResumeResources;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resumes = ResumeResources::collection(Resume::get());

return  $this->apiResponse($resumes,'$token','ok',200);
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
    
    public function store(ResumeRequest $request)
{
    $user = Auth::user();
    
    // Assuming you have a 'jobSeeker' method in your User model to access the associated JobSeeker
    $jobSeeker = $user->JobSeeker;

    if (!$jobSeeker) {
        // Handle the case where the user doesn't have an associated job seeker profile
        return $this->apiResponse(null,'', 'the resume not saved', 400);
    }

    $validated = $request->validated();

    $resume = Resume::create([
        'job_seeker_id' => $jobSeeker->id,
        'certificates_training_courses' => $request->certificates_training_courses,
        'experience' => $request->experience,
        'skills' => $request->skills,
        'languages' => $request->languages,
    ]);

    // Handle the response or redirect as needed
    return $this->apiResponse($resume, '', 'Resume saved successfully', 200);
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resume = Resume::find($id);
        if($resume){
            
            return $this->apiResponse(new ResumeResources($resume),'$token','ok',200);
        }
        return $this->apiResponse($resume,'$token','the resume not found',404);
    }
    /**
     * Show the form for editing the specified resource.
     */
    
    /**
     * Update the specified resource in storage.
     */
    public function update(ResumeRequest $request, string $id)
    {
    
    $resume = Resume::find($id);
    if(!$resume){
     return $this->apiResponse(null,'','the resume not found',404);
}
    $validatedData = $request->validated();
    $resume->update($validatedData);
    return $this->apiResponse(new ResumeResources($resume),'','the resume updated',404);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resume = Resume::find($id);
        if (!$resume) {

            return $this->apiResponse(null,'','this Resume not found', 404);
        }
        $resume->delete();

        return $this->apiResponse($resume,'', 'Resume deleted successfully', 200);

    }
}