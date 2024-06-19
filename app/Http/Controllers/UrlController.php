<?php

namespace App\Http\Controllers;

use App\Constants\RouteConstants;
use App\Http\Requests\ShortenUrlRequest;
use App\Models\Url;
use App\Resources\UrlResource;
use App\Services\ShortenUrlService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;

class UrlController extends Controller
{
    public function __construct(
        private readonly ShortenUrlService $shortenUrlService,
        private readonly UrlGenerator $urlGenerator
    ) {
    }

    public function shorten(ShortenUrlRequest $request): JsonResource
    {
        $url = $request->get('url');

        $hashedUrl = $this->shortenUrlService->shorten($url);

        return new UrlResource($hashedUrl);
    }

    public function redirect(string $path): RedirectResponse
    {
        /** @var ?Url $url */
        $url = $this->shortenUrlService->findBy('shorten_url', $this->urlGenerator->to($path));
        if (!$url) {
            return Redirect::route(RouteConstants::APP_INDEX);
        }

        return Redirect::to($url->original_url);
    }
}
