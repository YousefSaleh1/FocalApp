<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreUserinfo;
use App\Http\Resources\UserinfoResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadPhotoTrait;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserinfoController extends Controller
{
    use ApiResponseTrait , UploadPhotoTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_info = UserInfo::all();

        return $this->customeRespone(UserinfoResource::collection($user_info),'Data retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserinfo $request)
    {
        $validatedData = $request->validated();


        $user_id = Auth::user()->id;
        if (!empty($request->profile_photo)) {

            $path = $this->UploadPhoto($request, 'userInfos', 'profile_photo');
        } else {
            $path = null;
        }

        $user_info = UserInfo::create([
            'user_id'   => $user_id ,
            'full_name' => $request->full_name,
            'city_id' => $request->city_id ,
            'phone_number' => $request->phone_number ,
            'facebook_account' => $request->facebook_account ,
            'linked_in_account' => $request->linked_in_account ,
            'behanc_account' => $request->behanc_account ,
            'profile_photo' => $path,
        ]);

        if ($user_info) {
            return $this->apiResponse(new UserinfoResource($user_info), "", 'Successfully Created', 200);

        return $this->customeRespone(null,'Failed To Create', 400);
    }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_info = UserInfo::find($id);

        if (!$user_info) {
            return $this->customeRespone(null,'Not Found', 404);
        }

        return $this->customeRespone(new UserinfoResource($user_info),'Found', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserinfo $request, string $id)
    {
        $user_info = UserInfo::find($id);

        if (!$user_info) {
            return $this->customeRespone(null,'Not Found', 404);
        }

        $validatedData = $request->validated();
        if (!empty($request->profile_photo)) {

            $path = $this->UploadPhoto($request, 'userInfos', 'profile_photo');
        } else {
            $path = $user_info->profile_photo;
        }

        $user_info->update([
            'full_name' => $request->full_name,
            'city_id' => $request->city_id ,
            'phone_number' => $request->phone_number ,
            'facebook_account' => $request->facebook_account ,
            'linked_in_account' => $request->linked_in_account ,
            'behanc_account' => $request->behanc_account ,
            'profile_photo' => $path,
        ]);

        return $this->customeRespone(new UserinfoResource($user_info),'Successfully Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_info = UserInfo::find($id);

        if (!$user_info) {
            return $this->customeRespone(null,'Not Found', 404);
        }

        $user_info->delete();

        return $this->customeRespone( new UserinfoResource($user_info),"User Deleted", 200);
    }
}
