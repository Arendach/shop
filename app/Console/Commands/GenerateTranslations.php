<?php

namespace App\Console\Commands;

use App\Models\Attribute;
use App\Models\BannerImage;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Index;
use App\Models\Manufacturer;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use App\Models\ProductCollection;
use App\Models\Shop;
use App\Services\TranslateTextService;
use Illuminate\Console\Command;

class GenerateTranslations extends Command
{
    protected $signature = 'generate:translations';

    protected $description = 'Generate translations for database tables';

    private $models = [
        Product::class,
        Category::class,
        Page::class,
        ProductCollection::class,
        Attribute::class,
        BannerImage::class,
        Characteristic::class,
        Index::class,
        Manufacturer::class,
        Menu::class,
        MenuItem::class,
        ProductCharacteristic::class,
        Shop::class
    ];

    private $localeDefault;

    public function handle()
    {
        $this->localeDefault = config('locale.default');

        $this->info('Start translations');
        foreach ($this->models as $modelName) {
            $model = new $modelName;

            foreach ($model->translate as $field) {
                foreach (config('locale.support') as $locale) {
                    if ($locale == $this->localeDefault) {
                        continue;
                    }

                    $model->where("{$field}_{$locale}", '')->orWhereNull("{$field}_{$locale}")->get()->each(function ($row) use ($locale, $field) {
                        $defaultField = "{$field}_{$this->localeDefault}";
                        $localizeField = "{$field}_{$locale}";
                        if (!$row->$defaultField) {
                            return;
                        }

                        $text = app(TranslateTextService::class)->get($row->$defaultField, $locale);

                        if (preg_match('~^meta~', $localizeField)) {
                            $text = mb_substr($text, 0, 160);
                        }

                        $row->$localizeField = $text;
                        $row->save();
                    });
                }
            }

            $this->info("End translate of " . $modelName);
        }

        $this->info('SuccessFull');
    }
}
