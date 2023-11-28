<?php

namespace App\Http\Controllers\API;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\AddNewBlog;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\UploadPhotoTrait;
use Illuminate\Support\Facades\Notification;

class BlogController extends Controller
{
    use ApiResponseTrait, UploadPhotoTrait , NotificationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve blogs
        $blogs = Blog::where('status' , 'post')->get();

        // Return the blogs as a response
        return $this->customeRespone(BlogResource::collection($blogs), "Done!", 200);
    }

    public function store(BlogRequest $request)
    {
        $user_id = Auth::user()->id;
        if (!empty($request->photo)) {

            $path = $this->UploadPhoto($request, 'blogs', 'photo');
        } else {
            $path = null;
        }

        $blog = Blog::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'body' => $request->body,
            'photo' => $path,
            'status' => $request->status,
        ]);
        if ($request->has('categories')) {
            $blog->categories()->attach($request->input('categories'));
        }

        $responce = $this->BlogNotification($blog);
        return $responce;

        // return $this->customeRespone(new BlogResource($blog), "Blog Created Successfuly", 201);
    }

    public function show(string $id){
        $blog = Blog::find($id);
        if($blog){
            $blog->load('categories');
            return $this->customeRespone(new BlogResource($blog), "Done!", 200);
        }
        return $this->customeRespone(null, "not found", 404);
    }

    public function update(BlogRequest $request,string $id)
    {

        $blog = Blog::find($id);

        if (Auth::user()->id !== $blog->user_id) {
            return $this->customeRespone(null, 'You can only edit your own blog.', 403);
        } else {
            if (!empty($request->photo)) {

                $path = $this->UploadPhoto($request, 'blogs', 'photo');
            } else {
                $path = $blog->photo;
            }

            $blog->update([
                'title' => $request->title,
                'body' => $request->body,
                'photo' => $path,
                'status' => $request->status,
            ]);

            return $this->customeRespone(new BlogResource($blog), "Blog Updated Successfuly", 200);
        }
    }

    public function destroy(BlogRequest $blog)
    {
        if (Auth::user()->id == $blog->user_id || Auth::user()->role_name == ["admin"]) {
            $blog->delete();

            return $this->customeRespone(null , "Blog deleted successfully" , 204);
        }
        return $this->customeRespone(null, 'You can\'t delete', 403);
    }

    public function MyBlogs(){
        $user_id = Auth::user()->id;
        $blogs  = Blog::where('user_id' , $user_id)->get();
        if ($blogs) {
            return $this->customeRespone(BlogResource::collection($blogs), 'ok', 200);
        }
        return $this->customeRespone(null, 'blogs not found', 404);
    }

    /*
    *This method to display the blogs by status
    */
    public function get_status($status){
        $user_id = Auth::user()->id;
        $blogs = Blog::where('user_id' , $user_id)->where('status' , $status)->get();
        if ($blogs) {
            return $this->customeRespone(BlogResource::collection($blogs), 'ok', 200);
        }
        return $this->customeRespone(null, 'blogs not found', 404);
    }

}
