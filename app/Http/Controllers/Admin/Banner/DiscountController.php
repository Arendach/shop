<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Banner\DiscountStoreRequest;
use App\Http\Requests\Admin\Banner\DiscountUpdateRequest;
use App\Models\Discount;
use JavaScript;
use Illuminate\Support\Facades\Storage;

class DiscountController extends AdminController
{
    public function index()
    {
        $data = [
            'title' => __('banner.admin.discounts_title'),
            'breadcrumbs' => [
                [__('banner.admin.page_title'), route('banner.index')],
                [__('banner.admin.discounts_title')]
            ],
            'discounts' => Discount::paginate(config('app.items')),
        ];

        return view('admin.banner.discounts.index', $data);
    }

    public function destroy($id)
    {
        Discount::find($id)->delete();
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);

        JavaScript::put(['updateRoute' => route('discounts.update', $id)]);

        $data = [
            'title' => __('banner.admin.discounts_title'),
            'breadcrumbs' => [
                [__('banner.admin.page_title'), route('banner.index')],
                [__('banner.admin.discounts_title'), route('discounts.index')],
                [$discount->name]
            ],
            'discount' => $discount
        ];

        return view('admin.banner.discounts.edit', $data);
    }

    public function create()
    {
        JavaScript::put([
            'storeRoute' => route('discounts.store')
        ]);

        $data = [
            'title' => __('banner.admin.discounts_title'),
            'breadcrumbs' => [
                [__('banner.admin.page_title'), route('banner.index')],
                [__('banner.admin.discounts_title'), route('discounts.index')],
                [__('banner.admin.create_discount')]
            ]
        ];

        return view('admin.banner.discounts.create', $data);
    }

    public function store(DiscountStoreRequest $request)
    {
        $discount = new Discount;

        $discount->name_uk = $request->name_uk;
        $discount->name_ru = $request->name_ru;
        $discount->start = $request->start;
        $discount->finish = $request->finish;
        $discount->page = $request->page;
        $discount->published = 0;

        $discount->save();

        $discount->image_min_uk = $request->image_min_uk->store("banners/discount/{$discount->id}");
        $discount->image_min_ru = $request->image_min_ru->store("banners/discount/{$discount->id}");
        $discount->image_second_uk = $request->image_second_uk->store("banners/discount/{$discount->id}");
        $discount->image_second_ru = $request->image_second_ru->store("banners/discount/{$discount->id}");
        $discount->image_max_uk = $request->image_max_uk->store("banners/discount/{$discount->id}");
        $discount->image_max_ru = $request->image_max_ru->store("banners/discount/{$discount->id}");

        $discount->save();

        return response([
            'redirectRoute' => route('discounts.edit', $discount->id),
            'message' => __('banner.admin.discount_store_success_text')
        ], 200);
    }

    public function update(DiscountUpdateRequest $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $discount->name_uk = $request->name_uk;
        $discount->name_ru = $request->name_ru;
        $discount->start = $request->start;
        $discount->finish = $request->finish;
        $discount->page = $request->page;
        $discount->published = $request->published;
        // $discount->published = 1;

        $images = ['image_min_uk','image_min_ru','image_second_uk','image_second_ru','image_max_uk','image_max_ru',];

        foreach ($images as $item) {
            if ($request->{$item} !== null){
                Storage::delete($discount->{$item});

                $discount->{$item} = $request->{$item}->store("banners/discount/{$discount->id}");
            }
        }

        $discount->save();

        return response(['message' => __('banner.admin.discount_store_success_text')], 200);
    }
}
