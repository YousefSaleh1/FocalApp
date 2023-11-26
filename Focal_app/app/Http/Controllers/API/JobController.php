<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use  App\Models\CompanyJob;
use Illuminate\Http\Request;
use App\Models\BusinessOwner;
use App\Notifications\AddNewJob;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Notification;

class JobController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = CompanyJob::all();
        return $this->customeRespone(JobResource::collection($jobs),'registered successfully', 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        // $Validation = $request->validated();

        $user_id =  Auth::user()->id;
        $business_owner = BusinessOwner::where('user_id', $user_id)->first();
        $business_owner_id = $business_owner->id;
        $job = CompanyJob::create([
            'business_owners_id' => $business_owner_id,
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

        $job_id = CompanyJob::latest()->first();
        // $users = User::where('role_name',"freelancer")->get();

        $users = User::all();
        $notification = new AddNewJob($job_id);
        Notification::send($users, $notification);


        if ($job) {
            return $this->customeRespone([
                'job' => new JobResource($job),
                'notification' => [
                    'job_title' => $notification->toArray($users[0])['job_title'], // Assuming you want the title of the first user
                    'business_owner' => $notification->toArray($users[0])['business_owner'],
                ],
            ], "Blog Created Successfully", 200);
        }
        return $this->customeRespone(new JobResource($job),' job are not registered successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = CompanyJob::find($id);
        if (!$job) {
            return $this->customeRespone(null,'the jop is not found', 400);
        }
        $visitor =  $job->visit($id);
        return $this->customeRespone([new JobResource($job) , $visitor], 'the is jop', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, string $id)
    {
        $job = CompanyJob::find($id);

        $Validation = $request->validated();
        $user_id =  Auth::user()->id;
        $business_owner = BusinessOwner::where('user_id', $user_id)->first();
        $business_owner_id = $business_owner->id;
        $job->update([
            'business_owners_id' => $business_owner_id,
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
        if ($job) {
            return $this->customeRespone(new JobResource($job),'the jop is updated', 200);
        }
        return $this->customeRespone('','the jop is not updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $job = CompanyJob::find($id);
        if (!$job) {
            return $this->customeRespone('','the jop is not found', 404);
        }
        $job->delete();
        return $this->customeRespone('','the jop is deleted', 200);
    }

    public function visitor($id)
    {
        $visitor = CompanyJob::withTotalVisitCount()->where('id' , $id)->first()->visit_count_total;
        return $this->customeRespone($visitor,'visitor job', 200);
    }

    public function get_active_jops()
    {
        $jobs = CompanyJob::where('status', 'Active')->get();

        return $this->customeRespone(JobResource::collection($jobs),' this is an active job ', 200);
    }

    public function get_closed_jops()
    {

        $jobs = CompanyJob::where('status', 'Closed')->get();

        return $this->customeRespone(JobResource::collection($jobs),' this is an closed job ', 200);
    }



    public function get_wating_jops()
    {

        $jobs = CompanyJob::where('status', 'Waiting')->get();

        return $this->customeRespone(JobResource::collection($jobs),' this is an Waiting job ', 200);
    }
}
