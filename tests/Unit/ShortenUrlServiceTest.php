<?php

namespace Tests\Unit;

use App\Constants\UrlConstants;
use App\Services\GoogleSafeBrowsingService;
use App\Services\ShortenUrlService;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShortenUrlServiceTest extends TestCase
{
    #[Test]
    public function itPassesGoogleSafeBrowsingValidation(): void
    {
        $safeBrowsingService = App::make(GoogleSafeBrowsingService::class);
        $originalUrl = 'http://www.google.com';
        $data = $safeBrowsingService->checkSafeBrowsing($originalUrl);
        $this->assertArrayNotHasKey('matches', $data);
    }

    #[Test]
    public function itFailsGoogleSafeBrowsingValidation(): void
    {
        $safeBrowsingService = App::make(GoogleSafeBrowsingService::class);
        $originalUrl = 'http://malware.testing.google.test/testing/malware/';
        $data = $safeBrowsingService->checkSafeBrowsing($originalUrl);
        $this->assertArrayHasKey('matches', $data);
    }

    #[Test]
    public function itCreatesRandomHash(): void
    {
        $shortenUrlService = App::make(ShortenUrlService::class);
        $hash = $shortenUrlService->getUrlHash();
        $this->assertEquals(UrlConstants::SHORTEN_URL_HASH_LENGTH, strlen($hash));
    }
}
