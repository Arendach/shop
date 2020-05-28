<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Assets\ContentEditableRequest;
use App\Models\Translate;
use Illuminate\Http\Request;
use Cache;

class AssetsController extends CatalogController
{
    public function translates()
    {
        $translates = Cache::rememberForever('assets.translates', function () {
            return Translate::all()->mapWithKeys(function (Translate $translate) {
                return [$translate->original => $translate->content];
            });
        });

        $content = view('catalog.assets.translates', compact('translates'))->render();

        return response($content)->withHeaders([
            'Content-Type' => 'text/javascript'
        ]);
    }

    public function registerTranslate(Request $request)
    {
        return response()->json([
            'result' => translate($request->text)
        ]);
    }

    public function contentEditable(ContentEditableRequest $request)
    {
        $request->model::findOrFail($request->id)->update([
            $request->field => $request->value
        ]);

        artisan('cache:clear');
    }
}