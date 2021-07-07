<?php


namespace App\Services;

use App\Http\Requests\Admin\Banner\TopUpdateRequest;
use File;
use Storage;


class BannerService
{
    /**
     * @var string
     */
    public $photo = '';

    /**
     * @var string
     */
    public $color = '#fff';

    /**
     * @var string
     */
    public $page = '';

    /**
     * @var bool
     */
    public $active = false;

    /**
     * @var string
     */
    private $path = 'images/banner';

    /**
     * @var string
     */
    private $file = 'working/top_banner.json';


    public function __construct()
    {
        $this->boot();
    }

    private function boot()
    {
        if (File::exists(Storage::disk('local')->path($this->file))) {
            $banner = json_decode(Storage::disk('local')->get($this->file));

            $this->active = $banner->is_active;
            $this->photo = $banner->photo;
            $this->color = $banner->color;
            $this->page = $banner->page;
        }
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return route('page', $this->page);
    }

    public function getPhotoUrl(): string
    {
        return asset($this->photo);
    }

    public function setBanner(TopUpdateRequest $request): void
    {
        $old = json_decode($this->getFileContent());

        if ($request->photo != 'null'){
            if (is_file(Storage::disk('local')->path($old->photo ?? '')))
                unlink(Storage::disk('local')->path($old->photo ?? ''));
            $path = $request->photo->store($this->path);
        } else {
            $path = $old->photo ?? '';
        }

        Storage::disk('local')->put($this->file, json_encode([
            'photo' => $path,
            'color' => $request->color,
            'is_active' => $request->is_active,
            'page' => $request->page
        ]));
    }

    private function getFileContent(): string
    {
        if (File::exists(Storage::disk('local')->path('working/top_banner.json')))
            return Storage::disk('local')->get('working/top_banner.json');

        return '';
    }
}