<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreUserinfo;
use App\Http\Resources\UserinfoResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\UserInfo;



class UserinfoController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_info = UserInfo::all();

        return $this->apiResponse(UserinfoResource::collection($user_info), "", 'Data retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserinfo $request)
    {
        $validatedData = $request->validated();

        $user_info = UserInfo::create($validatedData);

        if ($user_info) {
            return $this->apiResponse(new UserinfoResource($user_info), "", 'Successfully Created', 201);
        }

        return $this->apiResponse(null, "", 'Failed To Create', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_info = UserInfo::find($id);

        if (!$user_info) {
            return $this->apiResponse(null, "", 'Not Found', 404);
        }

        return $this->apiResponse(new UserinfoResource($user_info), "", 'Found', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserinfo $request, string $id)
    {
        $user_info = UserInfo::find($id);

        if (!$user_info) {
            return $this->apiResponse(null, "", 'Not Found', 404);
        }

        $validatedData = $request->validated();

        $user_info->update($validatedData);

        return $this->apiResponse(new UserinfoResource($user_info), "", 'Successfully Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_info = UserInfo::find($id);

        if (!$user_info) {
            return $this->apiResponse(null, "", 'Not Found', 404);
        }

        $user_info->delete();

        return $this->apiResponse("", "", "User Deleted", 200);
    }
}
