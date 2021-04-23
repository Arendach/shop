<?php

namespace App\Traits\Observers;

trait DefaultTranslatableFields
{
    public function defaultTranslatableFields(&$model)
    {
        if ($model->translate) {
            foreach (config('locale.support') as $locale) {
                if (config('locale.default') == $locale) {
                    continue;
                }

                foreach ($model->translate as $field) {
                    $defaultLanguageValue = $model->{$field . '_' . config('locale.default')};
                    $otherLanguageValue = $model->{$field . '_' . $locale};
                    if (empty($defaultLanguageValue)) {
                        continue;
                    }

                    if (!empty($otherLanguageValue)) {
                        continue;
                    }

                    $model->{$field . '_' . $locale} = translate_text($defaultLanguageValue, $locale, true);
                }
            }
        }
    }
}