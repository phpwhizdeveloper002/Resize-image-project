<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;

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
Route::post('/banner/upload', [BannerController::class, 'upload'])->name('banner.upload');

Route::get('/', function () {
    return view('welcome');
});
