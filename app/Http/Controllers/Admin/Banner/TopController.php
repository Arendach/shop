<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Facades\Banner;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Banner\TopUpdateRequest;
use App\Models\Page;
use Storage;
use File;
use Illuminate\Http\Request;

class TopController extends AdminController
{
    public function section_main()
    {
        $data = [
            'title' => translate('Верхній баннер'),
            'breadcrumbs' => [[translate('Верхній банер')]]
        ];

        return view('admin.banner.top.main', $data);
    }

    public function action_update(TopUpdateRequest $request)
    {
        Banner::setBanner($request);

        return response(['message' => __('banner.admin.updated')], 200);
    }

    public function action_hint(Request $request)
    {
        $data = [
            'hints' => Page::where('uri_name', 'like', '%' . $request->value . '%')->limit(5)->get()
        ];

        return view('admin.banner.top.hint', $data);
    }
}
