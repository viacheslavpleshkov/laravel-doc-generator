<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Admin\SituationController;
use App\Models\User_fill_input;
use App\Repositories\DocumentKeyRepository;
use App\Repositories\SituationRepository;
use Illuminate\Http\Request;
use App\Repositories\TypeRepository;
use Illuminate\Support\Facades\Auth;

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
     * @var DocumentKeyRepository
     */
    protected $documentKeyRepository;

    /**
     * SiteController constructor.
     * @param TypeRepository $typeRepository
     * @param SituationRepository $situationRepository
     */
    public function __construct(TypeRepository $typeRepository, SituationRepository $situationRepository, DocumentKeyRepository $documentKeyRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->situationRepository = $situationRepository;
        $this->documentKeyRepository = $documentKeyRepository;
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
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function types($url)
    {
        $main = $this->typeRepository->getSiteUrl($url);
        if (isset($main)) {
            $situation = $this->situationRepository->getSitenAll($main->id);

            return view('site.pages.types', compact('main', 'situation'));
        } else
            abort(404);
    }

    public function situation($id)
    {
        $main = $this->documentKeyRepository->getSiteSituation($id);

        return view('site.pages.situation', compact('main'));
    }

    public function situation_form(Request $request)
    {
        $array = $request->except('_token');
        foreach (array_keys($array) as $value)
        {
            User_fill_input::create([
                'user_id' => Auth::user()->id,
                'document_id' => $value,
                'user_input' => $array[$value],
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function about()
    {
        return view('site.pages.about');
    }


    public
    function protect()
    {
        return view('site.pages.protect');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function terms_of_use()
    {
        return view('site.pages.terms-of-use');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function privacy_policy()
    {
        return view('site.pages.privacy-policy');
    }
}
