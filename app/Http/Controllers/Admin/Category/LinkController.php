<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Category\CreateLinkRequest;
use App\Http\Requests\Admin\Category\UpdateLinkRequest;
use App\Models\CategoryLink;
use Illuminate\Http\Request;

class LinkController extends AdminController
{
    public function action_create_form(Request $request)
    {
        return view('admin.categories.create_link', [
            'title' => __('category.admin.new_link'),
            'category_id' => $request->category_id,
            'modal_size' => 'lg'
        ]);
    }

    public function action_create(CreateLinkRequest $request)
    {
        CategoryLink::insert($request->all());

        return response(['message' => __('category.admin.success_created_link')], 200);
    }

    public function action_update_form(Request $request)
    {
        return view('admin.categories.edit_link', [
            'title' => __('category.admin.edit_link'),
            'link' => CategoryLink::findOrFail($request->id),
            'modal_size' => 'lg'
        ]);
    }

    public function action_update(UpdateLinkRequest $request)
    {
        CategoryLink::find($request->id)->update($request->all());

        return response(['message' => __('category.admin.success_updated_link')], 200);
    }

    public function action_delete(Request $request)
    {
        CategoryLink::destroy($request->id);
    }
}
