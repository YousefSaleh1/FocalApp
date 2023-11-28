<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeRequest;
use App\Http\Resources\ResumeResources;
use App\Http\Traits\ApiResponseTrait;
use App\Models\JobSeeker;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    use ApiResponseTrait;



    /**
     * Store a newly created resource in storage.
     */

    public function store(ResumeRequest $request)
    {
        $validator_data = $request->validated();
        $user_id = Auth::user()->id;
        $joobSeekr = JobSeeker::where('user_id', $user_id)->first();
        $joobSeekr_id =$joobSeekr->id;
        $resume = Resume::create([
            'job_seeker_id' => $joobSeekr_id,
            'certificates_training_courses' => $request->certificates_training_courses,
            'experience' => $request->experience,
            'skills' => $request->skills,
            'languages' => $request->languages,
        ]);

        if ($resume) {
            return $this->customeRespone(new ResumeResources($resume), 'the resume created successfully', 201);
        }
        return $this->customeRespone(null, 'the resume not added', 400);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resume = Resume::find($id);
        if ($resume) {

            return $this->customeRespone(new ResumeResources($resume), 'ok', 200);
        }
        return $this->customeRespone($resume, 'the resume not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResumeRequest $request, string $id)
    {
        $resume = Resume::find($id);
        if (!$resume) {
            return $this->customeRespone(null, 'the resume not found', 404);
        }
        $validatedData = $request->validated();

        $resume->update([
            'certificates_training_courses' => $request->certificates_training_courses,
            'experience' => $request->experience,
            'skills' => $request->skills,
            'languages' => $request->languages,
        ]);

        return $this->customeRespone(new ResumeResources($resume), 'the resume updated', 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resume = Resume::find($id);
        if (!$resume) {

            return $this->customeRespone(null, 'this Resume not found', 404);
        }
        $resume->delete();

        return $this->customeRespone(new ResumeResources($resume), 'Resume deleted successfully', 200);
    }
}
