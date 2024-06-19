<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Constants\RouteConstants;

Route::post('/shorten', [UrlController::class, 'shorten'])->name(RouteConstants::APP_SHORTEN_URL);
