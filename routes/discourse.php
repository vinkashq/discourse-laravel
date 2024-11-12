<?php

use Illuminate\Support\Facades\Route;
use Vinkas\Discourse\Http\Controllers\ConnectController;

Route::prefix('discourse/connect')::controller(ConnectController::class)::group(function () {
  Route::get('/{key}', 'show');
});
