<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     *  Index
     *
     *  @return View
     */
    public function index(): View
    {
        return view('pages.dashboard.index');
    }
}
