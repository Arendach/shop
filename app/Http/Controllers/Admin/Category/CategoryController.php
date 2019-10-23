<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Category\DeleteCategoryRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryInfoRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use File;

class CategoryController extends AdminController
{
    public function section_main()
    {
        $data = [
            'title' => __('category.admin.page_title'),
            'breadcrumbs' => [[__('category.admin.page_title')]],
            'categories' => Category::with('parent')
                ->orderBy('id', 'desc')
                ->paginate(config('app.items'))
        ];

        return view('admin.categories.index', $data);
    }

    public function action_delete(DeleteCategoryRequest $request)
    {
        Category::destroy($request->id);

        return response(null, 200);
    }

    public function section_update(Request $request)
    {
        $category = Category::findOrFail($request->id);

        $data = [
            'title' => __('category.admin.page_title'),
            'breadcrumbs' => [
                [__('category.admin.page_title'), route('admin.get', ['category', 'category', 'main'])],
                [$category->name]
            ],
            'category' => $category,
            'root_categories' => Category::where('parent_id', 0)->get()
        ];

        return view('admin.categories.edit', $data);
    }

    public function action_update(UpdateCategoryInfoRequest $request)
    {
        $category = Category::findOrFail($request->id);

        if ($category->slug != $request->slug)
            if (Category::where('slug', $request->slug)->count())
                return response([
                    'message' => __('category.admin.errors.slug_not_unique'),
                    'errors' => ['slug' => __('category.admin.errors.slug_not_unique')]
                ], 400);

        if ($category->parent_id != $request->parent_id) {
            if (Category::where('parent_id', $request->id)->count()) {
                return response([
                    'message' => __('common.error'),
                    'errors' => ['parent_id' => __('category.admin.errors.has_child')]
                ], 400);
            }
        }

        $category->update($request->all());

        return response([
            'title' => __('common.success'),
            'message' => __('category.admin.success_updated_text'),
        ], 200);
    }

    public function section_create()
    {
        $data = [
            'title' => __('category.admin.page_title'),
            'breadcrumbs' => [
                [__('category.admin.page_title'), route('categories.index')],
                [__('category.admin.new_category')]
            ],
            'root_categories' => Category::where('parent_id', 0)->get()
        ];

        return view('admin.categories.create', $data);
    }

    public function action_create(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());

        return response([
            'message' => __('common.success'),
            'redirectRoute' => route('admin.get', ['category', 'category', 'update']) . parameters(['id' => $category->id])
        ]);
    }

    public function action_update_image(Request $request)
    {
        $category = Category::findOrFail($request->id);

        File::deleteDirectory(public_path('images/categories/' . $request->id));

        $path = $request->image->store('images/categories/' . $request->id);

        $category->small = $path;
        $category->big = $path;

        $category->save();

        return redirect()
            ->to(route('admin.get', ['category', 'category', 'update']) . parameters(['id' => $category->id]) . '#photo')
            ->with([
                'message' => 'Фото оновлено!'
            ]);
    }
}
