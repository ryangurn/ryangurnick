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
        $page = Page::where('slug', '=', $request->getRequestUri())->first();

        $modules = $page->page_modules->sortBy('order');

        $menu = PageNavigation::all();

        $sitename = Setting::where('key', '=', 'sitename')->first();

        return view('page', compact('page', 'modules', 'menu', 'sitename'));
    }
}
