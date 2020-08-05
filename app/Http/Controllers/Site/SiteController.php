<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Repositories\TypeRepository;

class SiteController extends BaseController {

    protected $typeRepository;
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $main = $this->typeRepository->getAll();

        return view('site.pages.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('site.pages.about');
    }


    public function protect()
    {
        return view('site.pages.protect');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms_of_use()
    {
        return view('site.pages.terms-of-use');
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy_policy()
    {
        return view('site.pages.privacy-policy');
    }
}
