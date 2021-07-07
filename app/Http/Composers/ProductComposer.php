<?php

namespace App\Http\Composers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\View;

class ProductComposer
{
    public function compose(View $view)
    {
        $reviewsData = [
            'reviews'   => $this->getReviews($view->product),
            'customer'  => $this->getCustomer(),
            'links'     => [
                'login'        => route('login'),
                'createReview' => route('product.create_review'),
                'updateReview' => route('product.update_review')
            ],
            'productId' => $view->product->id
        ];

        // $reviewsData['reviews'][] = $reviewsData['customerReview'];

        $view->with(compact('reviewsData'));
    }

    private function getReviews(Product $product): array
    {
        $product->load(['reviews' => function (HasMany $builder) {
            $builder->when(isAuth(), function (Builder $builder) {
                $builder->where(function (Builder $builder) {
                    $builder->where('customer_id', customer()->id)->whereIn('is_checked', [0, 1]);
                })->orWhere(function (Builder $builder) {
                    $builder->where('customer_id', '!=', customer()->id)->where('is_checked', 1);
                });
            }, function (Builder $builder) {
                $builder->where('is_checked', 1);
            });
        }]);

        return ReviewResource::collection($product->reviews)->toArray(null);
    }

    private function getCustomer(): ?array
    {
        if (!isAuth()) {
            return null;
        }

        return (new CustomerResource(customer()))->toArray(null);
    }
}