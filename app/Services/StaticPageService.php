<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Collection;

class StaticPageService
{
    /**
     * @var Collection
     */
    private $pages;

    /**
     * StaticPageService constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $this->pages = Page::where('static', true)
            ->get(['name_uk', 'name_ru', 'uri_name']);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getName(string $key): string
    {
        $page = $this->pages->where('uri_name', $key)->first();

        if (is_null($page)) return '';

        return $page->name;
    }

}