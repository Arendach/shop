<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Models\BannerImage;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BannerUpdateRequest;
use App\Http\Requests\Admin\BannerStoreRequest;
use JavaScript;
use App\Http\Controllers\Admin\AdminController;

class BannerController extends AdminController
{
    private $path = 'images/banner';

    public function section_main()
    {
        $data = [
            'title' => 'Слайдер на главной странице',
            'breadcrumbs' => [['Слайдер на главной странице']],
            'images' => BannerImage::all()
        ];

        return view('admin.banner.banner.main', $data);
    }

    public function section_edit(Request $request)
    {
        $image = BannerImage::findOrFail($request->id);

        $data = [
            'title' => __('banner.admin.page_title'),
            'breadcrumbs' => [
                [__('banner.admin.page_title'), route('admin.get', ['banner', 'banner', 'main'])],
                [__('common.editing')]
            ],
            'image' => $image
        ];

        return view('admin.banner.banner.edit', $data);
    }

    public function action_update(BannerUpdateRequest $request)
    {
        BannerImage::find($request->id)->update($request->all());

        return response()->json(['message' => 'good']);
    }

    public function action_image_upload(Request $request)
    {
        // загружаємо нове фото
        $path = $request->file('image')->store($this->path);

        // запис з бд
        $image = BannerImage::find($request->image_id);

        // виядаляємо старе
        if (is_file(public_path($image->path)))
            unlink(public_path($image->path));

        // оновлюємо фото в бд
        $image->update(['path' => $path]);

        return response()->json([
            'message' => 'Фото загружено!',
            'path' => asset($path)
        ], 200);
    }

    public function section_create()
    {
        $data = [
            'title' => __('banner.admin.page_title'),
            'breadcrumbs' => [
                [__('banner.admin.page_title'), route('admin.get', ['banner', 'banner'. 'main'])],
                [__('banner.admin.creating')]
            ]
        ];

        return view('admin.banner.banner.create', $data);
    }

    public function action_store(BannerStoreRequest $request)
    {
        $data = $request->all();

        $data['path'] = $request->file('image')->store($this->path);

        unset($data['image']);

        $banner = new BannerImage;

        $id = $banner->insertGetId($data);

        return response()->json([
            'routeRedirect' => route('admin.get', ['banner', 'banner', 'edit']) . parameters(['id' => $id]),
            'title' => __('common.success'),
            'text' => __('banner.admin.created')
        ], 200);
    }

    public function action_destroy($id)
    {
        BannerImage::destroy($id);

        return response(null, 200);
    }
}
