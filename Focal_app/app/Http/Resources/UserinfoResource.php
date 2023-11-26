<?php
namespace App\Http\Controllers;
namespace App\Http\Resources;

use App\Models\City;
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
        $city = City::find($this->city_id);
        return [
            'full_name'         => $this->full_name,
            'city_id'           => $city->city_name,
            'phone_number'      => $this->phone_number,
            'facebook_account'  => $this->facebook_account,
            'linked_in_account' => $this->linked_in_account,
            'behanc_account'    => $this->behanc_account,
            'profile_photo'     => asset('photos/' . $this->profile_photo),
        ];
    }
}


