<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->public_id,
            'trading_name' => $this->trading_name,
            'owner_name' => $this->owner_name,
            'document' => $this->document,
            'coverage_area' => [
                'type' => $this->coverage_area['type'],
                'coordinates' => $this->coverage_area['coordinates'],
            ],
            'address' => [
                'type' => $this->address['type'],
                'coordinates' => $this->address['coordinates'],
            ],
        ];
    }
}
