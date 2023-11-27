<?php

namespace App\Http\Resources;

use Google\Service\PolyService\Format;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ComplainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'email'            => Auth::user()->email,
            'complain_type'    => $this->complain_type ,
            'complain_reason'  => $this->complain_reason ,
            'photoURL'         => asset('photos/' .$this->photoURL),
            'sended'           => $this->created_at->format('Y-m-d H:i:s'),

        ];
    }
}
