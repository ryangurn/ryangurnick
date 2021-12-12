<?php

use App\Models\Email;
use App\Models\Setting;
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

// add maintenance route
$maintanence = Setting::where('key', '=', 'maintenance')->first();
if ($maintanence != null && $maintanence->value)
{
    Route::get('/maintenance', function() {
        return response(view('errors.maintenance'), 503);
    })->name('maintenance');
}

// grab all the pages and add routes
$pages = Page::all();
if (!$pages->isEmpty())
{
    foreach ($pages as $page) {
        Route::get($page->slug, [$page->controller, $page->method])->name($page->name);
    }
}

// present mailable route
Route::get('/mailable/{email}', function (Email $email) {
    return new $email->class($email);
})->name('mailable');

require __DIR__.'/auth.php';
