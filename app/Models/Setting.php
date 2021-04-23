<?php

namespace App\Models;

use App\Traits\Models\Editable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Editable;

    public $timestamps = false;
    protected $guarded = [];

    public function getValueAttribute()
    {
        if (config('locale.current') != config('locale.default')) {
            if (is_null($this->{"value_" . config('locale.current')})) {
                return $this->{"value_" . config('locale.default')};
            }
        }

        return $this->{"value_" . config('locale.current')};
    }
}
