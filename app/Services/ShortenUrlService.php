<?php

namespace App\Services;

use App\Constants\UrlConstants;
use App\Repositories\UrlRepository;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method UrlRepository getRepository()
 */
class ShortenUrlService extends AbstractService
{
    public function __construct(
        public UrlRepository $repository,
        private readonly UrlGenerator $urlGenerator
    ) {
    }

    public function shorten(string $originalUrl): Model|Builder
    {
        $hashedUrl = $this->createHashedUrl($originalUrl);

        return $this->findOrCreate($originalUrl, $hashedUrl);
    }

    public function findOrCreate(string $originalUrl, string $shortenUrl): Model|Builder
    {
        $exists = $this->findByMultipleFields($originalUrl, $shortenUrl);

        if ($exists) {
            return $exists;
        }

        return $this->getRepository()->create([
            'original_url' => $originalUrl,
            'shorten_url' => $shortenUrl,
        ]);
    }

    public function findBy(string $column, string $shortenUrl): ?Model
    {
        return $this->getRepository()->getOneByColumn($column, $shortenUrl);
    }

    public function findByMultipleFields(string $originalUrl, string $shortenUrl): ?Model
    {
        return $this->getRepository()->getOneByMultipleColumns($originalUrl, $shortenUrl);
    }

    public function createHashedUrl(string $url): string
    {
        $parsedUrl = parse_url($url);
        $hash = $this->getUrlHash();

        if (is_array($parsedUrl) && isset($parsedUrl['path']) && array_key_exists('path', $parsedUrl)) {
            $path = $parsedUrl['path'];
            $segments = explode('/', $path);
            if (count($segments) > 1) {
                // folder url
                unset($segments[count($segments) - 1]);
                $implodedSegments = implode('/', $segments) . '/';
                $hash = $implodedSegments . $hash;
            }
        }

        return $this->urlGenerator->to($hash);
    }

    public function getUrlHash(): string
    {
        return Str::random(UrlConstants::SHORTEN_URL_HASH_LENGTH);
    }
}
