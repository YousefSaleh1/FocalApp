<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorBusinessOwnerRequest;
use App\Http\Resources\BusinessOwnerResource;
use App\Models\BusinessOwner;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\CreateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BusinessOwnerController extends Controller
{
    use ApiResponseTrait , CreateTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessOwner = BusinessOwner::all();
        return $this->customeRespone( BusinessOwnerResource::collection($businessOwner),'all bisnessOwner Acconts',200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorBusinessOwnerRequest $request)
    {
        $validation = $request->validated();

        $user_id=Auth::user()->id;

        $businessOwner = BusinessOwner::create([
            "user_id"               =>$user_id,
            "company_name"          =>$request->company_name,
            "company_field"         =>$request->company_field,
            "company_size"          =>$request->company_size,
            "year_founded"          =>$request->year_founded,
            "responsible_job_role"  =>$request->responsible_job_role,
            "company_number"        =>$request->company_number,
            "website"               =>$request->website,
        ]);
        $this->CreateWallete($user_id);
        if($businessOwner){
            return $this->customeRespone(new BusinessOwnerResource($businessOwner),'Created successfully',201);
        }else{
            return $this->customeRespone('','not created',400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $businessOwner = BusinessOwner::findOrFail($id);

        return $this->customeRespone(new BusinessOwnerResource($businessOwner),'Show successfully',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorBusinessOwnerRequest $request, string $id)
    {
        $businessOwner = BusinessOwner::findOrFail($id);
        $validation = $request->validated();
        $id=Auth::user()->id;
        $businessOwner->update([
            "user_id"               => $id,
            "company_name"          =>$request->company_name,
            "company_field"         =>$request->company_field,
            "company_size"          =>$request->company_size,
            "year_founded"          =>$request->year_founded,
            "responsible_job_role"  =>$request->responsible_job_role,
            "company_number"        =>$request->company_number,
            "website"               =>$request->website,
        ]);
        if($businessOwner){
            return $this->customeRespone(new BusinessOwnerResource($businessOwner),'Update successfully',200);

        }else{
            return $this->customeRespone('','not updated',400);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $businessOwner = BusinessOwner::findOrFail($id);
        $businessOwner->delete();
        return $this->customeRespone('','Delete successfully',200);
    }
}
