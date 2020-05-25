<?php

namespace App\Observers;

use Cache;

class TranslateObserver
{
    public function updated()
    {
        $this->clearCache();
    }

    public function created()
    {
        $this->clearCache();
    }

    public function deleted()
    {
        $this->clearCache();
    }

    private function clearCache()
    {
        Cache::forget('assets.translates');
    }
}