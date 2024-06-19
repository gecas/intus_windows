<?php

namespace Tests\Feature;

use App\Constants\RouteConstants;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UrlControllerFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function itReturnsHashedUrlFromOriginalUrl(): void
    {
        $originalUrl = 'https://www.google.com';

        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            );

        $this->assertDatabaseCount(Url::class, 1);
        /** @var Url $url */
        $url = Url::query()->latest()->first();
        $this->assertDatabaseHas(Url::class, ['shorten_url' => $url->shorten_url]);
    }

    #[Test]
    public function itReturnsSameUrlIfDuplicateIsSent(): void
    {
        $originalUrl = 'https://www.google.com';

        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            );

        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            );

        $this->assertDatabaseCount(Url::class, 1);
        /** @var Url $url */
        $url = Url::query()->latest()->first();
        $this->assertDatabaseHas(Url::class, ['shorten_url' => $url->shorten_url]);
    }

    #[Test]
    public function itFailsValidationWithInvalidUrl(): void
    {
        $originalUrl = 'www.google';
        $message = 'The url field must be a valid URL.';

        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            )
            ->assertStatus(422)
            ->assertJsonFragment(['message' => $message]);
    }

    #[Test]
    public function itFailsGoogleUrlValidationWithInvalidUrl(): void
    {
        $originalUrl = 'http://malware.testing.google.test/testing/malware/';
        $message = 'The url does not comply with Google safe browsing API';
        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            )
            ->assertStatus(422)
            ->assertJsonFragment(['message' => $message]);
    }

    #[Test]
    public function itRedirectsToOriginalUrlFromShortenUrl(): void
    {
        $originalUrl = 'https://www.google.com';

        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            );
        /** @var Url $url */
        $url = Url::query()->latest()->first();

        $this->getJson(
            route(RouteConstants::APP_REDIRECT, $url->shorten_url)
        )->assertRedirect($url->original_url);
    }

    #[Test]
    public function itRedirectsToIndexWhenShortUrlNotFound(): void
    {
        $originalUrl = 'https://www.google.com';

        $this
            ->postJson(
                route(RouteConstants::APP_SHORTEN_URL),
                ['url' => $originalUrl],
            );

        $url = 'www.randomurl.com';

        $this->getJson(
            route(RouteConstants::APP_REDIRECT, $url)
        )->assertRedirect('/');
    }
}
