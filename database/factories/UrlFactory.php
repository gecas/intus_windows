<?php

namespace Database\Factories;

use App\Services\ShortenUrlService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $originalUrl = $this->faker->url();
        $service = App::make(ShortenUrlService::class);
        $shortenUrl = $service->shorten($originalUrl);

        return [
            'original_url' => $originalUrl,
            'shorten_url' => $shortenUrl,
        ];
    }
}
