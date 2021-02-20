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
        try
        {
            $this->render = BBCode::convertFromHtml($value);
            $this->render = BBCode::convertToHtml($this->render);
            return $this->render;
        }
        catch (\Exception $exception)
        {
            return $value;
        }
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}