<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageNavigation;
use App\Models\Setting;
use App\Models\StatisticIpAddress;
use App\Models\StatisticSession;
use App\Models\StatisticView;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * handle storing session information for standard pages.
     * @param Request $request
     * @return void
     */
    public function handle_sessions(Request $request)
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
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return void
     */
    public function handle_views(Request $request, Page $page)
    {
        // save/update the page view count
        $count = StatisticView::firstOrNew([
            'session_id' => session()->getId(),
            'page_id' => $page->id
        ]);
        $count->count = $count->count + 1;
        $count->save();
    }

    /**
     * check if the application is in maintenance mode.
     * @return RedirectResponse|void
     */
    public function maintenance_check()
    {
        // check if maintenance mode
        $maintenance = Setting::where('key', '=', 'application.maintenance')->first();
        if ($maintenance != null && $maintenance->value && !auth()->check())
        {
            return redirect()->route('maintenance');
        }
    }

    /**
     * handle the rendering of views based on page types.
     * @param Page $page
     * @return Application|Factory|View
     */
    public function handle_page_template(Page $page, $identifier)
    {
        // get modules on page
        $modules = $page->page_modules->sortBy('order');

        // get the main menu
        $menu = PageNavigation::all();

        // get the site title setting
        $sitename = Setting::where('key', 'application.sitename')->first();

        return view($page->page_type->view, compact('page', 'modules', 'menu', 'sitename', 'identifier'));
    }
}
