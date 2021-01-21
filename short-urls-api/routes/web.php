<?php

use Illuminate\Support\Facades\Route;
use App\Models\Urls;
use App\Http\Controllers\UrlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{url}', [UrlController::class, 'show']);
Route::get('/', [UrlController::class, 'create']);
Route::post('/', [UrlController::class, 'store'])->name('add');