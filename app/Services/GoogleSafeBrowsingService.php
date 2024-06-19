<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class GoogleSafeBrowsingService
{
    /**
     * @param string $originalUrl
     * @return array<mixed>
     */
    public function checkSafeBrowsing(string $originalUrl): array
    {
        $googleApiKey = Config::get('google.google_api_key');
        if (!$googleApiKey) {
            abort(500, 'Google API Key not set');
        }
        $googleUrl = sprintf('https://safebrowsing.googleapis.com/v4/threatMatches:find?key=%s', $googleApiKey);

        $body = [
            "client" => [
                "clientId" => Config::get('app.name'),
                "clientVersion" => "1.5.2"
            ],
            "threatInfo" => [
                "threatTypes" => ["MALWARE", "SOCIAL_ENGINEERING"],
                "platformTypes" => ["WINDOWS"],
                "threatEntryTypes" => ["URL"],
                "threatEntries" => [
                    ["url" => $originalUrl],
                ]
            ]
        ];

        $response = Http::post($googleUrl, $body);

        return json_decode($response->body(), true);
    }
}
