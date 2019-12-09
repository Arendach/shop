<?php

namespace App\Services;

use App\Models\Settings;
use Cache;

class SettingsService
{
    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var mixed
     */
    private $storage;

    /**
     * SettingsService constructor.
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;

        if (Cache::has('settings'))
            $this->storage = Cache::get('settings');
        else
            $this->boot();
    }

    /**
     * Booting service
     */
    public function boot()
    {
        $this->storage = Settings::all();

        Cache::put('settings', $this->storage);
    }

    public function get($key)
    {
        return $this->storage->where('key', $key)->first()->value;
    }

    public function set($key, array $values)
    {
        if (Settings::where('key', $key)->count()) {
            Settings::where('key', $key)->update([
                'value_uk' => $values['value_uk'],
                'value_ru' => $values['value_ru']
            ]);
        }
    }
}