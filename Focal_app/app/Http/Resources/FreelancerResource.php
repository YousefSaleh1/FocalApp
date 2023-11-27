<?php

namespace App\Http\Resources;

use App\Models\Freelancer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        $userInfo = $user->user_info;
        return [
            'id'               => $this->id ,
            'freelancer infos' => new UserinfoResource($userInfo),
        ];
    }
}
