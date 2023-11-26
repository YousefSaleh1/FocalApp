<?php

namespace App\Http\Controllers\API;

use App\Models\Freelancer;
use App\Http\Requests\FreelancerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\FreelancerResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $freelancers = User::where('role_name','bloger')->get();
        $freelancers_info = $freelancers->user_info()->get();

        return $this->customeRespone(new FreelancerResource($freelancers_info), 'All Retrieve Freelance Success', 200);
    }

    public function store(FreelancerRequest $freelancerRequest)
    {
        $data = $freelancerRequest->validated();



        $id=Auth::user()->id;
        $freelance = Freelancer::create([
            'user_id' => $id,
        ]);

        return $this->customeRespone($freelance,'Freelance Created Successfully.', 201);
    }

    public function show($id)
    {
        $freelancer = Freelancer::find($id);

        if (!$freelancer) {
            return $this->customeRespone(null, 'Freelance Not Found!', 401);
        }

        return $this->customeRespone(new FreelancerResource($freelancer), 'Show Freelance Info.', 200);
    }

    public function edit(FreelancerRequest $freelancerRequest, $id)
    {
        $data = $freelancerRequest->validated();

        $freelancer = Freelancer::find($id);

        if (!$freelancer) {
            return $this->customeRespone(null, 'Freelance Not Found!', 404);
        }

        $updateFreelance = $freelancer->update([
            'user_id' => $data['user_id']
        ]);

        return $this->customeRespone(new FreelancerResource($updateFreelance), 'Freelance Update Successfully.', 201);
    }

    public function destroy($id)
    {
        $freelancer = Freelancer::find($id);

        if (!$freelancer) {
            return $this->customeRespone(null, 'Freelance Not Found!', 401);
        }

        $freelancer->delete();

        return $this->customeRespone(new FreelancerResource($freelancer), 'Deleted Freelance Successfully.', 200);
    }

}
