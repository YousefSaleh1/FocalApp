<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessOwnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "company_name"          => $this->company_name,
            "company_field"         => $this->company_field,
            "company_size"          => $this->company_size,
            "year_founded"          => $this->year_founded,
            "responsible_job_role"  => $this->responsible_job_role,
            "company_number"        => $this->company_number,
            "website"               => $this->website,
        ];
    }
}
