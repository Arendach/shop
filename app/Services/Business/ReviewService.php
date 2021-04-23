<?php

namespace App\Services\Business;

use App\Models\Product;
use App\Models\Review;

class ReviewService
{
    public function updateReview($id, $data): Review
    {
        // init data
        $data = collect($data)->merge(['is_checked' => 0]);

        // update review
        $review = Review::findOrFail($id);

        $review->update($data->toArray());

        // update product rating
        $rating = Review::where('is_checked', true)
            ->where('product_id', $review->product_id)
            ->avg('rating');

        Product::findOrFail($review->product_id)->update([
            'rating' => is_null($rating) ? 0 : $rating
        ]);

        return $review;
    }
}