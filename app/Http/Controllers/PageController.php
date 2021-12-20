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

        // render the view
        return $this->handle_page_template($page);
    }
}
