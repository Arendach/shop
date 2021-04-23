<?php

namespace App\Observers;

use Cache;
use App\Models\Page;

class PageObserver
{
    public function created(Page $page)
    {
        Cache::forget('fastNavigation');
    }

    public function updated(Page $page)
    {
        Cache::forget('fastNavigation');
    }

    public function deleted(Page $page)
    {
        Cache::forget('fastNavigation');
    }

    public function restored(Page $page)
    {
        Cache::forget('fastNavigation');
    }

    public function forceDeleted(Page $page)
    {
        Cache::forget('fastNavigation');
    }
}
