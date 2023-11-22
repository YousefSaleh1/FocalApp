<?php

namespace App\Http\Controllers\API;

use  App\Models\CompanyJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Http\Requests\JopRequest;
use App\Http\Resources\JopResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\AuthController;

class JopController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jops = CompanyJob::all();
        return $this->apiResponse(new JopResource($jops), '', 'registered successfully', 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(JopRequest $request)
    {
        $Validation = $request->validated();

        if ($Validation->fails()) {
            return $this->apiResponse(null, null, $Validation->errors, 'arr not correct', 400);
        }
        $business_owners_id = Auth::user()->id;
        $jops = CompanyJob::create([
            'business_owners_id' => $business_owners_id,


            'job_title' => $request->job_title,
            'job_role' => $request->job_role,
            'job_level' => $request->job_level,
            'experience' => $request->experience,
            'education_level' => $request->education_level,
            'language' => $request->language,
            'age_range' => $request->age_range,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'job_type' => $request->job_type,
            'address' => $request->address,
            'work_hour' => $request->work_hour,
            'salary_range' => $request->salary_range,
            'help' => $request->help,
            'job_discription' => $request->job_discription,
            'job_requirement' => $request->job_requirement,
            'status' => $request->status,
            'cancel_desc' => $request->cancel_desc,
        ]);
        if ($jops) {
            return $this->apiResponse(new JopResource($jops), '', 'registered successfully', 200);
        }
        return $this->apiResponse(new JopResource($jops), '', ' job are not registered successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jops = CompanyJob::find($id);
        if (!$jops) {
            return $this->apiResponse(null, '', 'the jop is not found', 400);
        }
        return $this->apiResponse(new JopResource($jops), '', 'the is jop', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JopRequest $request, string $id)
    {
        $jop = CompanyJob::find($id);

        $Validation = $request->validated();

        if ($Validation->fails()) {
            return $this->apiResponse($Validation->errors(), '', '', 400);
        }
        $business_owners_id = Auth::user()->id;
        $jop->update([
            'business_owners_id' => $business_owners_id,
            'job_title' => $request->job_title,
            'job_role' => $request->job_role,
            'job_level' => $request->job_level,
            'experience' => $request->experience,
            'education_level' => $request->education_level,
            'language' => $request->language,
            'age_range' => $request->age_range,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'job_type' => $request->job_type,
            'address' => $request->address,
            'work_hour' => $request->work_hour,
            'salary_range' => $request->salary_range,
            'help' => $request->help,
            'job_discription' => $request->job_discription,
            'job_requirement' => $request->job_requirement,
            'status' => $request->status,
            'cancel_desc' => $request->cancel_desc,
        ]);
        if ($jop) {
            return $this->apiResponse(new JopResource($jop), '', 'the jop is updated', 200);
        }
        return $this->apiResponse('', '', 'the jop is not updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $jop = CompanyJob::find($id);
        if (!$jop) {
            return $this->apiResponse('', '', 'the jop is not found', 404);
        }
        $jop->delete();
        return $this->apiResponse('', '', 'the jop is deleted', 200);
    }
}
