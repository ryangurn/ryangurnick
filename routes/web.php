<?php

use App\Models\Email;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ResumeController;

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

// grab all the pages and add routes
$pages = Page::all();
if (!$pages->isEmpty())
{
    foreach ($pages as $page) {
        Route::get($page->slug, [$page->controller, $page->method])->name($page->name);
    }
}

Route::get('/mailable/{email}', function (Email $email) {
    return new $email->class($email);
})->name('mailable');

require __DIR__.'/auth.php';
