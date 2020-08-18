<?php

namespace App\Http\Controllers\Site;

use App\Repositories\NewsRepository;
use App\Repositories\SituationRepository;
use App\Repositories\TypeRepository;
use App\Repositories\DocumentFileRepository;

class SiteController extends BaseController
{

    /**
     * @var TypeRepository
     */
    protected $typeRepository;

    /**
     * @var SituationRepository
     */
    protected $situationRepository;

    /**
     * @var NewsRepository
     */
    protected $newsRepository;
    /**
     * @var DocumentFileRepository
     */
    protected $documentFileRepository;
    /**
     * SiteController constructor.
     * @param TypeRepository $typeRepository
     * @param SituationRepository $situationRepository
     * @param NewsRepository $newsRepository
     */
    public function __construct(TypeRepository $typeRepository,
                                SituationRepository $situationRepository,
                                NewsRepository $newsRepository,
                                DocumentFileRepository $documentFileRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->situationRepository = $situationRepository;
        $this->newsRepository = $newsRepository;
        $this->documentFileRepository = $documentFileRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $main = $this->typeRepository->getSiteAll();
        $news = $this->newsRepository->getSiteAll();

        return view('site.pages.index', compact('main','news'));
    }

    /**
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function types($url)
    {
        $main = $this->typeRepository->getSiteUrl($url);
        if (isset($main)) {
            $situation = $this->situationRepository->getSitenAll($main->id);
            $documents = $this->documentFileRepository->getAll();

            return view('site.pages.types', compact('main', 'situation', 'documents'));
        } else
            abort(404);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('site.pages.about');
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
