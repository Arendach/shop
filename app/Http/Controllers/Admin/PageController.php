<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use App\Models\Page;

class PageController extends AdminController
{
    public function index()
    {
        $data = [
            'title' => __('pages.title'),
            'breadcrumbs' => [[__('pages.title')]],
            'pages' => Page::paginate(config('app.items'))
            //'pages' => []
        ];

        return view('admin.pages.index', $data);
    }

    public function destroy($id)
    {
        Page::find($id)->delete();
    }

    public function create()
    {
        $data = [
            'title' => __('pages.title'),
            'breadcrumbs' => [
                [__('pages.title'), route('pages.index')],
                [__('pages.new_page')]
            ],
            'js' => ['ckeditor/ckeditor']
        ];

        return view('admin.pages.create', $data);
    }

    public function store(PageStoreRequest $request)
    {
        $id = Page::insertGetId($request->all());

        return response([
            'id' => $id,
            'action' => 'redirect',
            'redirectRoute' => route('pages.edit', ['page' => $id])
        ], 200);
    }

    public function edit($id)
    {
        $page = Page::findOrFAil($id);

        $data = [
            'title' => __('pages.title'),
            'breadcrumbs' => [
                [__('pages.title'), route('pages.index')],
                [$page->uri_name]
            ],
            'js' => ['ckeditor/ckeditor'],
            'page' => $page
        ];

        return view('admin.pages.update', $data);
    }

    public function update(PageUpdateRequest $request, $id)
    {
        Page::find($id)->fill($request->all())->save();

        return response(['message' => __('common.success')], 200);
    }
}
