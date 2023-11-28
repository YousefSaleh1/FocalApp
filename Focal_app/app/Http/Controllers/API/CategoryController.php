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
        $categories = Category::all();

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
        if ($category) {
            $category->load('blogs');
            return $this->customeRespone(new CategoryResource($category), 'show category is done', 200);
        }
        return response()->json(['message' => 'category not found '], 404);
    }

    public function update(CategoryRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->role_name = 'admin') {
            $category = Category::find($id);
            if ($category) {
                $category->update($request->all());


                return $this->customeRespone(new CategoryResource($category), 'Category Updated Successfuly', 200);
            }
            return response()->json(['message' => 'category not found '], 404);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role_name == 'admin') {
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                return response()->json(['message' => 'category was deleted'], 200);
            }
            return response()->json(['message' => 'category not found '], 404);
        }
        return response()->json(['error' => 'you do not have permission to delete this category,,,,sorry'], 403);
    }
}
