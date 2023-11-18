<?php

namespace App\Http\Controllers\API;

use App\Models\Freelancer;
use App\Http\Requests\FreelancerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\FreelancerResource;
use App\Http\Traits\ApiResponseTrait;

class FreelancerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $freelancer = Freelancer::all();

        return $this->customeRespone(new FreelancerResource($freelancer), 'All Retrive Freallnce Success', 200);
    }

    public function store(FreelancerRequest $freelancerRequest)
    {
        $data = $freelancerRequest->validated();

        $freelance = Freelancer::create([
            'user_id' => $data['user_id'],
        ]);

        return $this->customeRespone(new FreelancerResource($freelance), 'Freelance Created Successfully.', 201);
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
            return $this->customeRespone(null, 'Freelance Not Found!', 401);
        }

        $updateFreelance = $freelancer->update([
            'user_id' => $data['user_id']
        ]);

        return $this->customeRespone(new FreelancerResource($updateFreelance), 'Freelance Update Suucessfully.', 201);
    }

    public function destroy($id)
    {
        $freelancer = Freelancer::find($id);

        if (!$freelancer) {
            return $this->customeRespone(null, 'Freelance Not Found!', 401);
        }

        $freelancer->destroy();

        return $this->customeRespone(new FreelancerResource($freelancer), 'Deleted Freelance Successfully.', 200);
    }

}
