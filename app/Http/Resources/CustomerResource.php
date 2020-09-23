<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Customer $this */
        return [
            'id'         => $this->id,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'locale'     => $this->locale
        ];
    }
}
