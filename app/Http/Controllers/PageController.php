<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageNavigation;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        // handle all the session data
        $this->handle_sessions($request);

        // handle the maintenance redirection
        if ($this->maintenance_check() != null)
        {
            // return the redirect response.
            return $this->maintenance_check();
        }

        // get page
        $page = Page::where('slug', '=', $request->getRequestUri())->first();

        // handle the view statistics
        $this->handle_views($request, $page);

        // get modules on page
        $modules = $page->page_modules->sortBy('order');

        // get the main menu
        $menu = PageNavigation::all();

        // get the site title setting
        $sitename = Setting::where('key', 'application.sitename')->first();

        // render the view
        return view('page', compact('page', 'modules', 'menu', 'sitename'));
    }
}
