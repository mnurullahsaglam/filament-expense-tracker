<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Enums\CurrencyEnum;

Route::get('/', function () {
    dd(CurrencyEnum::getRandomName());
    dd(CurrencyEnum::getRandomName());
});
