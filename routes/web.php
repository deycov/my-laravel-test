<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiConsumerController;

Route::get('/', function () {
    return redirect('cats');
});

Route::resource('/cats', ApiConsumerController::class );
