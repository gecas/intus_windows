<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Url
 *
 *
 * @property int $id
 * @property string $original_url
 * @property string $shorten_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Url extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'shorten_url'];
}
