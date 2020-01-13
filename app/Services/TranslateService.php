<?php

namespace App\Services;

use App\Models\Translate;
use Cache;
use Google\Cloud\Translate\V2\TranslateClient;

class TranslateService
{
    private $translate;

    private $cacheKey = 'translate';

    public function __construct()
    {
        $this->boot();
    }

    private function boot()
    {
        if (!Cache::has($this->cacheKey)) {
            Cache::forever($this->cacheKey, $this->readAll());
        }

        $this->translate = Cache::get($this->cacheKey);
    }

    public function get($text): ?string
    {
        if (!isset($this->translate[$text])) {
            $this->translate($text);
        }

        return $this->translate[$text]->content;
    }

    private function translate($text)
    {
        $client = new TranslateClient();
        $translate = new Translate();

        $translate->original = $text;
        $translate->created_at = now();
        $translate->updated_at = now();
        $translate->{"content_" . config('locale.default')} = $text;
        foreach (config('locale.support') as $language) {
            if ($language == config('locale.default')) continue;

            $result = $client->translate($text, [
                'target' => $language,
                'source' => config('locale.default'),
                'key'    => config('api.google')
            ]);

            if (preg_match('~^[А-Я]~', $text)) {
                $translate->{"content_$language"} = ucfirst($result['text'] ?? '');
            } else {
                $translate->{"content_$language"} = $result['text'] ?? '';
            }
        }

        $translate->save();

        $this->forgetCache();
        $this->boot();
    }

    private function readAll()
    {
        return Translate::all()->mapWithKeys(function (Translate $item) {
            return [$item->original => $item];
        });
    }

    public function forgetCache()
    {
        Cache::forget($this->cacheKey);
    }

}