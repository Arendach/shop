<?php

namespace App\Http\Resources;

use App\Models\NewPostCity;
use Illuminate\Http\Resources\Json\JsonResource;

class NewPostCityResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var NewPostCity $this */
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'ref'    => $this->ref,
            'prefix' => $this->prefix
        ];
    }
}
