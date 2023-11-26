<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;

class CategoryController extends Controller
{
    use ApiResponseTrait ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                   // Query the desired data
                   $category = Category::all();
                    // return $category ;
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

    public function show($id)
    {
      $category = Category::find($id);

      return $this->customeRespone($category,['show category is done'],200);
    }

    public function update(CategoryRequest $request,$id)
    {
      $category = Category::find($id);
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

    public function destroy($id)
    {
      $category= Category::find($id);
      if(auth()->user()->hasRole('admin')){
          $category->delete();
      return response()->json(['message'=>'category was deleted'],200) ;
          }
      return response()->json(['error'=>'you do not have permission to delete this category,,,,sorry'], 403);
    }

}
