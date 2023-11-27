<?php

namespace App\Http\Resources;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BlogResource extends JsonResource
{

    public function toArray($request)
    {
        $user_id = $this->user_id;
        $userInfo = UserInfo::where('user_id' , $user_id)->first();
        return [
            'id'            => $this->id,
            'blogerName'    => $userInfo->full_name,
            'profile_photo' =>asset('photos/' . $userInfo->profile_photo) ,
            'title'         => $this->title,
            'body'          => $this->body,
            'updated_at'    => $this->created_at->format('Y-m-d'),
            'photo'         => asset('photos/' . $this->photo),
            'status'        => $this->status,
        ];
    }
}
