<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Translate;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class TranslateController extends AdminController
{
    public function section_main()
    {
        $data = [
            'phrases'     => Translate::all(),
            'title'       => translate('Адмінка :: Переклади'),
            'breadcrumbs' => [
                [translate('Налаштування'), url('admin/settings/index/index')],
                [translate('Переклади')]
            ]
        ];

        return view('admin.settings.translate.main', $data);
    }

    public function action_update_form(int $id)
    {
        $phrase = Translate::findOrFail($id);

        return view('admin.settings.translate.update_form', [
            'phrase'     => $phrase,
            'title'      => $phrase->original,
            'modal_size' => 'lg'
        ]);
    }

    public function action_update(Request $request, TranslateService $translateService)
    {
        Translate::findOrFail($request->id)->update($request->all());

        $translateService->forgetCache();

        return response()->json([
            'message' => translate('Дані успішно збережені')
        ]);
    }
}
