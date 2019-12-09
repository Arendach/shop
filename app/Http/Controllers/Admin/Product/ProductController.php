<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Product\ProductInfoUpdateRequest;
use App\Http\Requests\Admin\Product\UpdateSeoRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AdminController
{
    public function section_main()
    {
        $data = [
            'title' => __('products.admin.page_title'),
            'breadcrumbs' => [[__('products.admin.page_title')]],
            'products' => Product::with('category')
                ->orderBy('id', 'desc')
                ->paginate(config('app.items'))
        ];

        return view('admin.products.index', $data);
    }

    public function section_update(Request $request)
    {
        $product = Product::with('images')
            ->with('characteristics')
            ->findOrFail($request->id);

        $categories = Category::where('parent_id', 0)
            ->with('child')
            ->get();

        if ($product->characteristics->pluck('id')){

        }

        $data = [
            'title' => __('products.admin.page_title'),
            'breadcrumbs' => [
                [__('products.admin.page_title'), route('admin.get', ['product', 'product', 'main'])],
                [$product->name]
            ],
            'product' => $product,
            'categories' => $categories
        ];

        return view('admin.products.edit', $data);
    }

    public function action_update(ProductInfoUpdateRequest $request)
    {
        Product::find($request->id)->update($request->all());

        return response()->json(['message' => __('products.admin.success_updated')], 200);
    }

    public function action_update_seo(UpdateSeoRequest $request)
    {
        Product::find($request->id)->update($request->all());

        return response()->json(['message' => __('common.success_text')], 200);
    }
}
