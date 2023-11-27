<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogerResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Bloger;
use App\Models\User;
use Illuminate\Http\Request;

class BlogerController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $blogers = Bloger::all();
        return $this->customeRespone(BlogerResource::collection($blogers) ,"All Retrieve Blogers Success" , 200)  ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Bloger $bloger)
    {;

        if (!$bloger) {
            return $this->customeRespone(null, 'Bloger Not Found!', 401);
        }

        return $this->customeRespone(new BlogerResource($bloger), 'Show Bloger Info.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bloger $bloger)
    {

        if (!$bloger) {
            return $this->customeRespone(null, 'bloger Not Found!', 401);
        }

        $bloger->delete();

        return $this->customeRespone(new BlogerResource($bloger), 'Deleted Freelance Successfully.', 200);
    }
}
