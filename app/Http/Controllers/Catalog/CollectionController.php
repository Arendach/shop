<?php

namespace App\Http\Controllers\Catalog;

use App\Models\ProductCollection;
use Illuminate\Http\Request;

class CollectionController extends CatalogController
{
    public function index()
    {
        $collections = ProductCollection::where('parent_id', 0)
            ->with('child')
            ->get();

        $data = [
            'title' => __('collection.meta.title'),
            'meta_keywords' => __('collection.meta.keywords'),
            'meta_description' => __('collection.meta.description'),
            'collections' => $collections,
            'breadcrumbs' => [[__('collection.meta.title')]]
        ];

        return view('catalog.collection.index', $data);
    }

    public function view(Request $request, $slug)
    {
        $collection = ProductCollection::with('parent')
            ->with('items')
            ->with('child')
            ->where(is_numeric($slug) ? 'id' : 'slug', $slug)
            ->firstOrFail();



        $data = [
            'title' => $collection->meta_title,
            'meta_keywords' => $collection->meta_keywords,
            'meta_description' => $collection->meta_description,
            'collection' => $collection
        ];

        if ($collection->parent_id == 0){
            $data['breadcrumbs'] = [
                [__('collection.meta.title'), route('collections')],
                [$collection->name]
            ];

            return view('catalog.collection.parent', $data);
        } else {
            $data['breadcrumbs'] = [
                [__('collection.meta.title'), route('collections')],
                [$collection->parent->name, route('collection', $collection->parent->slug)],
                [$collection->name]
            ];

            return view('catalog.collection.child', $data);
        }
    }
}
