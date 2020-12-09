<?php

namespace App\Http\Resources;

use App\Models\Streets;
use Illuminate\Http\Resources\Json\JsonResource;

class NewPostStreetsResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Streets $this */
        return [
            'id'     => $this->id,
            'city'     => $this->city,
            'district' => $this->district,
            'street_type'    => $this->street_type,
            'name'   => $this->name
        ];
    }
}
