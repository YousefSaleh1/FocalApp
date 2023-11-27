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
        $freelancers = Freelancer::all();

        return $this->customeRespone(FreelancerResource::collection($freelancers), 'All Retrieve Freelance Success', 200);
    }

    public function show($id)
    {
        $freelancer = Freelancer::find($id);

        if (!$freelancer) {
            return $this->customeRespone(null, 'Freelance Not Found!', 401);
        }

        return $this->customeRespone(new FreelancerResource($freelancer), 'Show Freelance Info.', 200);
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
