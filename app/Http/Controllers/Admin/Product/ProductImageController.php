<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Product\ImageUploadRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends AdminController
{
    public function action_update_form(Request $request)
    {
        $data = [
            'title' => 'update image',
            'image' => ProductImage::findOrFail($request->id)
        ];

        return view('admin.products.forms.update_image', $data);
    }

    public function action_upload_form(Request $request)
    {
        $data = [
            'title' => 'Add image',
            'product_id' => $request->id
        ];

        return view('admin.products.forms.upload', $data);
    }

    public function action_change_main(Request $request)
    {
        $product = Product::find($request->product_id);
        $image = ProductImage::find($request->image_id);

        $product->big = $image->big;
        $product->small = $image->small;

        $product->save();

        return response()->json([
            'message' => 'Зображення товару змінено!',
            'action' => 'reload'
        ]);
    }

    public function action_delete(Request $request)
    {
        $image = ProductImage::findOrFail($request->id);

        // видаляємо велике фото
        if (is_file($image->big)) unlink(public_path($image->big));

        // видаляємо маленьке фото
        if (is_file($image->small)) unlink(public_path($image->small));

        // видаляємо запис з бази даних
        $image->delete();

        // відповідь
        return response()->json([], 200);
    }

    public function action_update(Request $request)
    {
        ProductImage::findOrFail($request->id)->update($request->all());

        return response()->json([
            'message' => 'Updated!',
            'action' => 'reload'
        ], 200);
    }

    public function action_upload(ImageUploadRequest $request)
    {
        $product = Product::find($request->product_id);

        foreach ($request->images as $item) {
            $original = $item->store('temp');

            $name = basename($original);

            [$width, $height, $type, $attr] = getimagesize(public_path($original));

            $folder = "images/products/{$product->id}/";

            // якщо папки не існує то створюємо
            if (!is_dir(public_path($folder)))
                mkdir(public_path($folder), 0777, true);

            \Image::make(public_path($original))
                ->resize($width / ($height / 800), 800)
                ->save(public_path($folder . 'big_' . $name));

            \Image::make(public_path($original))
                ->resize($width / ($height / 400), 400)
                ->save(public_path($folder . 'small_' . $name));

            $img = new ProductImage;

            $img->alt_uk = $request->alt_uk != '' ? $request->alt_uk : $product->article;
            $img->alt_ru = $request->alt_ru != '' ? $request->alt_ru : $product->article;
            $img->priority = $request->priority;
            $img->product_id = $request->product_id;
            $img->big = $folder . 'big_' . $name;
            $img->small = $folder . 'small_' . $name;

            $img->save();

            if($product->small == '' && $product->big == '') {
                $product->small = $folder . 'small_' . $name;
                $product->big = $folder . 'big_' . $name;

                $product->save();
            }
        }

        return response()->json([
            'message' => 'Фото успішно завантажені!'
        ], 200);
    }
}
