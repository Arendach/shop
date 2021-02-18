<?php
namespace App\Casts;

use Genert\BBCode\Facades\BBCode;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PageAttributeCasts implements CastsAttributes
{

    protected $localeCurrent;

    protected $localeDefault;
    public $render;
    public function __construct()
    {
        $this->localeCurrent = config('locale.current');
        $this->localeDefault = config('locale.default');
    }

    public function get($model, string $key, $value, array $attributes)
    {
        $this->render = BBCode::convertFromHtml($value);
        $this->render = BBCode::convertToHtml($value);
        return $this->render;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}