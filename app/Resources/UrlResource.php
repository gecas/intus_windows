<?php

namespace App\Resources;

use App\Models\Url;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /** @var Url */
    public $resource;

    /**
     * @param $request
     * @return array<float|int|string>
     */
    public function toArray($request): array
    {
        return [
            'original_url' => $this->resource->original_url,
            'shorten_url' => $this->resource->shorten_url,
        ];
    }
}
