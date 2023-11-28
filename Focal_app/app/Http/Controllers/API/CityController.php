<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\CityResource;
use App\Http\Requests\StoreCity;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CityController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = City::all();
        return $this->customeRespone(CityResource::collection($city), 'done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCity $request)
    {
        $validate = $request->validated();
        $user = Auth::user();
        if ($user->role_name = 'admin') {
            $city = City::create([
                'city_name' => $request->city_name,
            ]);

            if ($city) {
                return $this->customeRespone(new CityResource($city), 'Successful', 201);
            }
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city = City::find($id);

        if (!$city) {
            return $this->customeRespone(null, 'city Not Found!', 401);
        }

        return $this->customeRespone(new CityResource($city), 'successful', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCity $request, string $id)
    {
        $user = Auth::user();
        if ($user->role_name = 'admin') {
            $city = City::find($id);
            if (!$city) {
                return $this->customeRespone(null, 'not found', 404);
            }
            $validate = $request->validated();

            $city->update($validate);
            return $this->customeRespone(new CityResource($city), 'Successfully Updated', 200);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $user = Auth::user();
        if ($user->role_name = 'admin') {
            $city->delete();
            return $this->customeRespone(null, 'deleted', 200);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }
}
