<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Query the desired data
        $categories = Category::all();
        // return $category ;
        // Return a JSON response
        return $this->customeRespone(CategoryResource::collection($categories), 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $user = Auth::user();
        if ($user->role_name = 'admin') {
            $category = Category::create([
                'title' => $request->title,
            ]);

            return $this->customeRespone(new CategoryResource($category), 'Category Created Successfuly', 201);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }

    public function show($id)
    {
        $category = Category::find($id);
        $category->load('blogs');

        return $this->customeRespone(null, 'show category is done', 200);
    }

    public function update(CategoryRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->role_name = 'admin') {
            $category = Category::find($id);

            $category->update($request->all());


            return $this->customeRespone(new CategoryResource($category), 'Category Updated Successfuly', 201);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $user = Auth::user();
        if ($user->role_name == 'admin') {
            $category->delete();
            return response()->json(['message' => 'category was deleted'], 200);
        }
        return response()->json(['error' => 'you do not have permission to delete this category,,,,sorry'], 403);
    }
}
