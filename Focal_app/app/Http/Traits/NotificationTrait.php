<?php

namespace App\Http\Traits;

use App\Http\Resources\BlogResource;
use App\Http\Resources\JobResource;
use App\Models\User;
use App\Notifications\AddNewBlog;
use App\Notifications\AddNewJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


trait NotificationTrait
{
    public function BlogNotification($blog)
    {
        $users = User::all();
        $blog->load('categories');
        $notification = new AddNewBlog($blog);
        Notification::send($users, $notification);
        return $this->customeRespone([
            'blog' => new BlogResource($blog),
            'notification' => [
                'title' => $notification->toArray($users[0])['title'], // Assuming you want the title of the first user
                'user' => $notification->toArray($users[0])['user'],
            ],
        ], "Blog Created Successfully", 200);
    }

    public function JobNotification($job)
    {
        $users = User::all();
        $notification = new AddNewJob($job);
        Notification::send($users, $notification);

        return $this->customeRespone([
            'job' => new JobResource($job),
            'notification' => [
                'job_title' => $notification->toArray($users[0])['job_title'], // Assuming you want the title of the first user
                'business_owner' => $notification->toArray($users[0])['business_owner'],
            ],
        ], "Job Created Successfully", 200);
    }
}
