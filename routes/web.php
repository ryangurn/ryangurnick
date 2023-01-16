<?php

use App\Models\Email;
use App\Models\Module;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\QueryException;
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

/**
 * add the maintenance route if the application is in
 * maintenance mode.
 */
if (config('app.routes_enabled')) {
    try {
        $maintenance = Setting::where('key', '=', 'application.maintenance')->first();
    } catch (QueryException $q) {
        abort(404);
    }

    Route::get('/maintenance', function () use ($maintenance) {
        if ($maintenance != null && $maintenance->value) {
            return abort(503);
        } else {
            return redirect()->route('home');
        }
    })->name('maintenance');

    /**
     * create a sitemap route for seo optimization so that
     * search engines can find the various pages on your
     * site.
     */
    Route::get('/sitemap.xml', function () {
        $pages = Page::all();
        $posts = Module::where('component', 'blog.post')->first()->page_modules->unique('hash');

        return response(view('sitemap', compact('pages', 'posts')), 200, ['Content-Type' => 'application/xml']);
    })->name('sitename');

    /**
     * add all the page routes as long as the pages' table
     * is not empty, if the pages' table is empty then any route
     * will result in a 404.
     */
    try {
        $pages = Page::all();
    } catch (QueryException $q) {
        abort(404);
    }
    if (! $pages->isEmpty()) {
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
