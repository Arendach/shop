<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;

class NewPostPaymentResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Streets $this */
        return [
            'id'     => $this->id,
            'name'     => $this->name,
            'description' => $this->description
        ];
    }
}
