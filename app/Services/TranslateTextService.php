<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;

class TranslateTextService
{
    public function get($text, string $language = 'ru', bool $decode = true): ?string
    {
        $client = new TranslateClient();

        if (config('api.use_goggle_api')) {
            $result = $client->translate(htmlspecialchars_decode($text), [
                'target' => $language,
                'source' => config('locale.default'),
                'key'    => config('api.google'),
                'format' => 'html'
            ]);

        } else {
            $result['text'] = $text;
        }

        if (!isset($result['text'])) {
            return null;
        }

        if ($decode) {
            $result['text'] = htmlspecialchars_decode($result['text']);
        }

        return $result['text'];
    }
}