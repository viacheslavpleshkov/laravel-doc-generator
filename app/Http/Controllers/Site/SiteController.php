<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('site.index');
    }
    public function about()
    {
        return view('site.about');
    }
    public function terms_of_use()
    {
        return view('site.about');
    }
    public function privacy_polic()
    {
        return view('site.about');
    }
}
