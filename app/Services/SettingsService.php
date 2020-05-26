<?php

namespace App\Services;

use App\Models\Setting;
use Cache;

class SettingsService
{
    public function get(string $key, $default = null)
    {
        $settings = Cache::rememberForever('settings', function () {
            return Setting::all();
        });

        $record = $settings->where('key', $key)->first();

        if (!$record) {
            $this->save($key, $default);

            return $default;
        }

        return $record->value;
    }

    private function save($key, $default = null)
    {
        Setting::create([
            'key'      => $key,
            'value_uk' => $default,
            'value_ru' => $default,
        ]);

        Cache::forget('settings');
    }
}