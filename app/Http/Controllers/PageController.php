<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageNavigation;
use App\Models\Setting;
use App\Models\StatisticIpAddress;
use App\Models\StatisticSession;
use App\Models\StatisticView;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        // save the session for analytics purposes
        $session = StatisticSession::firstOrNew([
            'session_id' => session()->getId(),
        ]);
        $session->user_agent = $request->userAgent();
        $session->save();

        // save the ip address related to the session
        $ip = StatisticIpAddress::firstOrNew([
            'session_id' => session()->getId(),
            'ip_address' => $request->ip()
        ]);
        $ip->save();

        // check if maintenance mode
        $maintenance = Setting::where('key', '=', 'maintenance')->first();
        if ($maintenance != null && $maintenance->value && !auth()->check())
        {
            return redirect()->route('maintenance');
        }

        // get page
        $page = Page::where('slug', '=', $request->getRequestUri())->first();

        // save/update the page view count
        $count = StatisticView::firstOrNew([
            'session_id' => session()->getId(),
            'page_id' => $page->id
        ]);
        $count->count = $count->count + 1;
        $count->save();

        // get modules on page
        $modules = $page->page_modules->sortBy('order');

        // get the main menu
        $menu = PageNavigation::all();

        // get the site title setting
        $sitename = Setting::where('key', '=', 'sitename')->first();

        // render the view
        return view('page', compact('page', 'modules', 'menu', 'sitename'));
    }
}
