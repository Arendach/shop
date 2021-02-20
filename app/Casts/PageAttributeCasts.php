<?php
namespace App\Casts;

use Genert\BBCode\Facades\BBCode;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PageAttributeCasts implements CastsAttributes
{

    protected $localeCurrent;

    protected $localeDefault;
    public function __construct()
    {
        $this->localeCurrent = config('locale.current');
        $this->localeDefault = config('locale.default');
    }

    public function get($model, string $key, $value, array $attributes)
    {
        try
        {
            if ($value)
            {
                $value = BBCode::convertFromHtml($value);
                $value = BBCode::convertToHtml($value);
            }
            return $value;
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