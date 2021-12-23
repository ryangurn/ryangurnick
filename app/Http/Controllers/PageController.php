<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request, $identifier = null)
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
        $page = Page::where('name', '=', $request->route()->getName())->first();

        // handle the view statistics
        $this->handle_views($request, $page);

        // render the view
        return $this->handle_page_template($page, $identifier);
    }
}
