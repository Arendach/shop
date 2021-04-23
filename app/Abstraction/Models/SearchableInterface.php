<?php

namespace App\Abstraction\Models;

interface SearchableInterface
{
    public function getUrl(): ?string;

    public function getSearchIndex(): string;

    public function getSearchType(): string;

    public function toSearchArray(): array;
}