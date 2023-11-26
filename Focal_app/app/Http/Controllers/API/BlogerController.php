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

        $blogers = User::where('role_name' , 'bloger')->get();
        $blogers_info = $blogers->user_info()->get();
        return $this->customeRespone(BlogerResource::collection($blogers_info) ,"" , 200)  ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bloger = new Bloger;
        $bloger->id = $request->id;
        $bloger->save();
        return response()->json($bloger, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bloger $bloger)
    {
        return response()->json(new BlogerResource($bloger), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bloger $bloger)
    {
        $bloger->update([
            'user_id' => $request->user_id,
        ]);
        return response()->json($bloger, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bloger $bloger)
    {
        $bloger->delete();
        return response()->json($bloger, 200);
    }
}
