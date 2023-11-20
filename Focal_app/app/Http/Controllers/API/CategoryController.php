<?php

namespace App\Http\API\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                   // Query the desired data
                   $category = Category::all();

                   // Return a JSON response
                   return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
      $category = Category::create([
        'title' => $request->title,
      ]);

      return new CategoryResource($category);
    }

    public function show(Category $category)
    {
      return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
 $validatedData = $request->validate([
    'title' =>'required','string','max:255',
]);

$category->update($validatedData);

$updatedAt = $category->updated_at;


return response()->json([
    'message' => 'Resource updated successfully',
    'updated_at' => $updatedAt,
]);

    }

    public function destroy(Category $category)
    {
      $category->delete();

      return response()->json(null, 204);
    }

}