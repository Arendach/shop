<?php

namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    public function creating(Review $review)
    {
        if (!$review->customer_id) {
            $review->customer_id = customer()->id;
        }

        if (is_null($review->is_checked)) {
            $review->is_checked = 0;
        }

        return $review;
    }
}
