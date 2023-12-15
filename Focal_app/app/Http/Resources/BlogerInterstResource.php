<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogerInterstResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = Category::find($this->category_id);
        return [
            'id'       => $this->id,
            'bloger'   =>  $this->bloger_id,
            'category' =>  new CategoryResource($category)
        ];
    }
}
