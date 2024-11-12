<?php

use Illuminate\Support\Facades\Route;
use Vinkas\Discourse\Http\Controllers\ConnectController;

Route::prefix('discourse')->middleware('web')->group(function () {
  Route::prefix('connect')->controller(ConnectController::class)->group(function () {
    Route::get('/{key}', 'show');
  });
});
