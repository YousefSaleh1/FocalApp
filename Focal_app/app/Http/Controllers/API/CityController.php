<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\CityResource;
use App\Http\Requests\StoreCity;
use App\Models\City;
use Illuminate\Support\Facades\Validator;


class CityController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city= City::all();
        return $this->apiResponse(CityResource::collection($city),"",'done!',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCity $request)
    {
        $validate = $request->validated();

        $city=City::create([
            'city_name'=>$request->city_name,
        ]);

        if($city){
        return $this->apiResponse(new CityResource($city),"",'Successful',200);
      }
      return $this->apiResponse(null,"",'not found',404);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCity $request, string $id)
    {
        $city = City::find($id);
        if(!$city){
           return $this->apiResponse(null,"",'not found',404);
        }
        $validate = $request->validated();

            $city->update($validate);
            return $this->apiResponse(new CityResource($city),"",'Successfully Updated',200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return $this->apiResponse("","",'deleted',200);
    }
}

