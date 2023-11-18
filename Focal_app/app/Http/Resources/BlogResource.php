<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{

        public function toArray($request)
        {
          return [
            'user_id' => $this->user_id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'photo' => $this->photo,
            'status' => $this->status,
          ];
        }

}