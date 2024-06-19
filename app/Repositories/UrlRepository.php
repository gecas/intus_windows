<?php

namespace App\Repositories;

use App\Models\Url;

class UrlRepository extends AbstractRepository
{
    public function modelClass(): string
    {
        return Url::class;
    }

    public function getOneByColumn(string $column, string $value): ?Url
    {
        /** @var Url */
        return $this->reset()->getBuilder()
            ->where($column, $value)
            ->first();
    }

    public function getOneByMultipleColumns(string $originalUrl, string $shortenUrl): ?Url
    {
        /** @var Url */
        return $this->reset()->getBuilder()
            ->where('original_url', $originalUrl)
            ->orWhere('shorten_url', $shortenUrl)
            ->first();
    }
}
