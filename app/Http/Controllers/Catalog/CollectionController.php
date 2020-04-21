<?php

namespace App\Http\Controllers\Catalog;

use App\Models\ProductCollection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class CollectionController extends CatalogController
{
    public function index()
    {
        $collections = ProductCollection::where('parent_id', 0)
            ->with('child')
            ->get();

        $data = [
            'title'            => __('collection.meta.title'),
            'meta_keywords'    => __('collection.meta.keywords'),
            'meta_description' => __('collection.meta.description'),
            'collections'      => $collections,
            'breadcrumbs'      => [[__('collection.meta.title')]]
        ];

        return view('catalog.collection.index', $data);
    }

    public function view(Request $request, $slug)
    {
        $collection = ProductCollection::with('parent')
            ->with('child')
            ->where(is_numeric($slug) ? 'id' : 'slug', $slug)
            ->firstOrFail();

        $data = [
            'title'            => $collection->meta_title,
            'meta_keywords'    => $collection->meta_keywords,
            'meta_description' => $collection->meta_description,
            'collection'       => $collection,
            'products'         => $collection->products()->paginate(12)
        ];

        if ($collection->parent_id == 0) {
            $data['breadcrumbs'] = [
                [translate('Колекції товарів'), route('collections')],
                [$collection->name]
            ];

            return view('catalog.collection.show', $data);
        } else {
            $data['breadcrumbs'] = [
                [translate('Колекції товарів'), route('collections')],
                [$collection->parent->name, route('collection', $collection->parent->slug)],
                [$collection->name]
            ];

            return view('catalog.collection.child', $data);
        }
    }
}
