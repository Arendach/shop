<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Product\CollectionImageUpdateRequest;
use App\Http\Requests\Admin\Product\CollectionInfoUpdateRequest;
use App\Http\Requests\Admin\Product\CollectionSeoUpdateRequest;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\ProductCollectionItems;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CollectionController extends AdminController
{
    public function section_main(Request $request)
    {
        $collections = ProductCollection::where('parent_id', 0)
            ->with(['child', 'parent'])
            ->get();

        $data = [
            'title'       => 'Collections',
            'breadcrumbs' => [
                ['Товари', route('admin.get', ['product', 'product', 'main'])],
                ['Колекції']
            ],
            'collections' => $collections
        ];

        return view('admin.products.collection.main', $data);
    }

    public function section_update(Request $request, ProductCollection $productCollection)
    {
        $collection = $productCollection->findOrFail($request->id);

        $collection->load('items', 'child', 'parent');

        $collection->items->load('category');

        $collections = $productCollection->root();

        $data = [
            'title'       => 'Колекції',
            'collection'  => $collection,
            'collections' => $collections,
            'breadcrumbs' => [
                ['Товари', route('admin.get', ['product', 'product', 'main'])],
                ['Колекції', route('admin.get', ['product', 'collection', 'main'])],
                [$collection->name]
            ]
        ];

        return view('admin.products.collection.update', $data);
    }

    public function action_update_info(CollectionInfoUpdateRequest $request)
    {
        ProductCollection::findOrFail($request->id)->update($request->all());

        return json([
            'title'   => __('common.update.success_title'),
            'message' => __('common.update.success_text')
        ]);

    }

    public function action_update_seo(CollectionSeoUpdateRequest $request)
    {
        ProductCollection::findOrFail($request->id)->update($request->all());

        return json([
            'title'   => __('common.update.success_title'),
            'message' => __('common.update.success_text')
        ]);
    }

    public function action_detach_product(Request $request)
    {
        ProductCollection::findOrFail($request->collection_id)
            ->items()
            ->detach($request->product_id);

        return json([
            'title'   => __('common.delete.success_title'),
            'message' => __('common.delete.success_text')
        ]);
    }

    public function action_attach_products(Request $request)
    {
        ProductCollection::findOrFail($request->collection_id)
            ->items()
            ->attach($request->ids);

        return json([
            'title'   => __('common.store.success_title'),
            'message' => __('common.store.success_text')
        ]);
    }

    public function action_search_products(Request $request, ProductCollection $productCollection)
    {
        $products = $productCollection->getSearchedProducts($request);

        $content = view('admin.products.collection.search_products', compact('products'))
            ->render();

        return json(compact('content'));
    }

    public function action_update_image(CollectionImageUpdateRequest $request)
    {
        $collection = ProductCollection::findOrFail($request->id);

        if (is_file(public_path($collection->getOriginal('image'))))
            unlink(public_path($collection->getOriginal('image')));

        $collection->image = $request->file('image')->store('images/collections');

        $collection->save();


        return json(['message' => 'Фото успішно оновлено!']);
    }

    public function section_create(ProductCollection $productCollection)
    {
        $collections = $productCollection->root();

        $data = [
            'title'       => 'Колекції',
            'collections' => $collections,
            'breadcrumbs' => [
                ['Товари', route('admin.get', ['product', 'product', 'main'])],
                ['Колекції', route('admin.get', ['product', 'collection', 'main'])],
            ]
        ];

        return view('admin.products.collection.create', $data);
    }

    public function action_create(Request $request)
    {
        $id = ProductCollection::create($request->all())->id;

        return response()->json([
            'action'        => 'redirect',
            'redirectRoute' => route('admin.get', ['product', 'collection', 'update']) . parameters(['id' => $id])
        ]);
    }
}
