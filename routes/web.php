<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs/scalar', function () {
    return view('scalar', [
        'specUrl' => url('/docs/api.json'),
    ]);
});
