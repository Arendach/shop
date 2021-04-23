<?php

namespace App\Traits;

use App\Observers\ElasticObserver;
use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopePrepareSearch(Builder $builder): void
    {
        // $builder->where('is_active', true);
    }

    public static function bootSearchable(): void
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticObserver::class);
        }
    }

    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    public function getSearchType(): string
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}