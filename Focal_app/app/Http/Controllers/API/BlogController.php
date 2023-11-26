<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;
use App\Http\Traits\ApiResponseTrait;

class BlogController extends Controller
{
  use ApiResponseTrait ;
    /**
     * Display a listing of the resource.
     */
    public function index($status)
    {
        // Retrieve blogs based on the status
        $blogs = Blog::where('status', $status)->get();

        // Return the blogs as a response
        return response()->json($blogs);
    }

    public function store(BlogRequest $request)
    {
      $blog = Blog::create([
        'user_id' => $request->user()->id,
        'title' => $request->title,
        'body' => $request->body,
        'photo' => $request->photo,
        'status' => $request->status,
      ]);

       return response()->json(['message' => 'Resource updated successfully']);
    }

    public function show($id)
    {
      $blog=Blog::find($id);
      return response()->json($blog, 200);
    }

    public function update(BlogRequest $request, Blog $blog)
    {

      if ($request->user()->id !== $blog->user_id) {
        return response()->json(['error' => 'You can only edit your own blog.'], 403);
      }

      $blog->update($request->only(['title','body','photo','status',]));
      $updatedAt = $blog->updated_at;

      return response()->json([
        'message' => 'Resource updated successfully',
        'updated_at' => $updatedAt,
    ]);
    }

    public function destroy(BlogRequest $blog)
    {
      $blog->delete();

      return response()->json(null, 204);
    }

}