<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;

class TranslateTextService
{
    public function get($text, string $language = 'ru'): ?string
    {
        dump($text);
        $client = new TranslateClient();

        $result = $client->translate(htmlspecialchars_decode($text), [
            'target' => $language,
            'source' => config('locale.default'),
            'key'    => config('api.google'),
            'format' => 'html'
        ]);

        return $result['text'] ?? '';
    }
}