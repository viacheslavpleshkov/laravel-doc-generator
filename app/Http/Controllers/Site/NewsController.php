<?php

namespace App\Http\Controllers\Site;

use App\Repositories\NewsRepository;

/**
 * Class NewsController
 * @package App\Http\Controllers\Site
 */
class NewsController extends BaseController
{
    /**
     * @var NewsRepository
     */
    protected $newsRepository;

    /**
     * NewsController constructor.
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $main = $this->newsRepository->getAll();

        return view('site.news.index', compact('main'));
    }

    /**
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news($url)
    {
        $item = $this->newsRepository->getNewsUrl($url);
        if (isset($item))
            return view('site.news.view', compact('item'));
        else
            abort(404);
    }
}
