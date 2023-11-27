<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogerResource extends JsonResource
{
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        $userInfo = $user->user_info;
        return [
            'id'               => $this->id,
            'freelancer infos' => new UserinfoResource($userInfo),
        ];
    }
}
