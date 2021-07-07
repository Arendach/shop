<?php

namespace App\Http\Resources;

use App\Models\Review;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Review $this */
        return [
            'id'         => $this->id,
            'comment'    => $this->comment,
            'rating'     => $this->rating,
            'stars'      => $this->stars,
            'date'       => $this->created_at->diffForHumans(),
            'is_checked' => $this->is_checked,
            'customer'   => [
                'id'   => $this->customer->id,
                'name' => $this->customer->name,
            ]
        ];
    }
}
