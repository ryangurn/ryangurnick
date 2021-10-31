<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $pageTitle = 'home';
    return view('index', compact('pageTitle'));
})->name('home');

Route::get('/photos', function () {
    $pageTitle = 'photos';
    return view('photos', compact('pageTitle'));
})->name('photos');

require __DIR__.'/auth.php';
