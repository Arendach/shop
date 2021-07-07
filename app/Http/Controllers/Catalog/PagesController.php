<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Faq;
use App\Models\Page;

class PagesController extends CatalogController
{
    public function index($name)
    {
        $page = Page::where('uri_name', $name)->firstOrFail();

        $data = [
            'title'            => $page->meta_title,
            'meta_keywords'    => $page->meta_keywords,
            'meta_description' => $page->meta_description,
            'page'             => $page,
            'breadcrumbs'      => [[$page->name]]
        ];

        return view('catalog.pages.view', $data);
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)->get();

        return view('catalog.pages.faq', compact('faqs'));
    }
}
