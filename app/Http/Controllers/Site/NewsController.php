<?php

namespace App\Http\Controllers\Site;

use App\Repositories\NewsRepository;

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
