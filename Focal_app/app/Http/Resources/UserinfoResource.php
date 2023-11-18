<?php
namespace App\Http\Controllers;
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserinfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'full_name'         => $this->full_name,
            'city'              => $this->city,
            'phone_number'      => $this->phone_number,
            'facebook_account'  => $this->facebook_account,
            'linked_in_account' => $this->linked_in_account,
            'behanc_account'    => $this->behanc_account,
            'profile_photo'     => $this->profile_photo,
            'status'            => $this->status, 
        ];
    }
}


