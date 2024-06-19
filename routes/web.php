<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Constants\RouteConstants;

Route::get('/', function () {
    return view('app');
})->name(RouteConstants::APP_INDEX);

Route::get('/{any?}', [UrlController::class, 'redirect'])->where('any', '.*')->name(RouteConstants::APP_REDIRECT);
