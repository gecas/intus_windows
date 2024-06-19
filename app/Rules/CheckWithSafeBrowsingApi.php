<?php

namespace App\Rules;

use App\Services\GoogleSafeBrowsingService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\App;

class CheckWithSafeBrowsingApi implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $safeBrowsingService = App::make(GoogleSafeBrowsingService::class);

        try {
            $data = $safeBrowsingService->checkSafeBrowsing($value);
            if (array_key_exists('matches', $data)) {
                /** @var string $message */
                $message = __('The url does not comply with Google safe browsing API');
                $fail($message);
            }
        } catch (\Exception $exception) {
            $fail('Something went wrong. Check API configuration and try again.');
            logger()->error($exception->getMessage());
        }
    }
}
