<?php

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use App\Models\Page;

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

/**
 * add the maintenance route if the application is in
 * maintenance mode.
 */
if (config('app.routes_enabled'))
{
    $maintenance = Setting::where('key', '=', 'application.maintenance')->first();
    Route::get('/maintenance', function() use ($maintenance) {
        if ($maintenance != null && $maintenance->value) {
            return abort(503);
        }
        else
        {
            return redirect()->route('home');
        }
    })->name('maintenance');

    /**
     * add all the page routes as long as the pages' table
     * is not empty, if the pages' table is empty then any route
     * will result in a 404.
     */
    $pages = Page::all();
    if (!$pages->isEmpty())
    {
        foreach ($pages as $page) {
            Route::get($page->slug, [$page->controller, $page->method])->name($page->name);
        }
    }

    /**
     * create a mailable route for previewing the various
     * contacts that have been submitted through the contact
     * module.
     */
    Route::get('/mailable/{email}', function (Email $email) {
        return new $email->class($email);
    })->name('mailable');
}

require __DIR__.'/auth.php';
