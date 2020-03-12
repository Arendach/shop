<?php

namespace App\Observers;

use App\Models\Index;
use DB;
use Cache;

class IndexObserver
{
    public function created(Index $index)
    {
        Cache::forget('globalData');
    }

    public function updating(Index $index)
    {
        if ($index->isDirty('is_main') && $index->is_main === true) {
            DB::table('indexes')->update([
                'is_main' => 0
            ]);
        }
    }

    public function updated()
    {
        Cache::forget('globalData');
    }

    public function deleted(Index $index)
    {
        Cache::forget('globalData');
    }

    public function restored(Index $index)
    {
        Cache::forget('globalData');
    }

    public function forceDeleted(Index $index)
    {
        Cache::forget('globalData');
    }
}
