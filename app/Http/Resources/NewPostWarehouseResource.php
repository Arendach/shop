<?php

namespace App\Http\Resources;

use App\Models\NewPostWarehouse;
use Illuminate\Http\Resources\Json\JsonResource;

class NewPostWarehouseResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var NewPostWarehouse $this */
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'ref'              => $this->ref,
            'city_ref'         => $this->city_ref,
            'number'           => $this->number,
            'max_weight_place' => $this->max_weight_place,
            'max_weight_all'   => $this->max_weight_all,
            'phone'            => $this->phone,
            'city_id'          => $this->city_id
        ];
    }
}
