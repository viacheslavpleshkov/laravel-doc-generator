<?php

namespace App\Http\Controllers\Site;

use App\Repositories\DocumentKeyRepository;
use App\Repositories\SituationRepository;
use App\Repositories\UserFillInputRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SituationController extends BaseController
{

    /**
     * @var SituationRepository
     */
    protected $situationRepository;

    /**
     * @var DocumentKeyRepository
     */
    protected $documentKeyRepository;

    /**
     * @var UserFillInputRepository
     */
    protected $userFillInputRepository;

    /**
     * SituationController constructor.
     * @param SituationRepository $situationRepository
     * @param DocumentKeyRepository $documentKeyRepository
     * @param UserFillInputRepository $userFillInputRepository
     */
    public function __construct(SituationRepository $situationRepository,
                                DocumentKeyRepository $documentKeyRepository,
                                UserFillInputRepository $userFillInputRepository)
    {
        $this->situationRepository = $situationRepository;
        $this->documentKeyRepository = $documentKeyRepository;
        $this->userFillInputRepository = $userFillInputRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $situation = $this->situationRepository->getById($id);

        if (isset($situation)) {
            $main = $this->documentKeyRepository->getSiteSituation($situation->document_file_id);
            $data = $this->userFillInputRepository->getSiteSituation(1000);
            if (Auth::check())
                $data = $this->userFillInputRepository->getSiteSituation(Auth::user()->id);

            return view('site.situation.situation', [
                'main' => $main,
                'data' => $data,
                'situation' => $situation->id
            ]);
        } else
            abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function form(Request $request)
    {
        $situation_id = $request->id;
        $array = $request->except('_token');

        foreach (array_keys($array) as $value) {
            $this->userFillInputRepository->create([
                'user_id' => Auth::user()->id,
                'document_id' => $value,
                'situation_id' => $situation_id,
                'user_input' => $array[$value],
            ]);
        }

        return redirect()->route('site.payment.index', $situation_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_form(Request $request)
    {
        $situation_id = $request->id;
        $array = $request->except('_token');

        foreach (array_keys($array) as $value) {
            $this->userFillInputRepository
                ->where('user_id', Auth::user()->id)
                ->where('document_id', $value)
                ->where('situation_id', $situation_id)
                ->update([
                    'user_input' => $array[$value],
                ]);
        }

        return redirect()->route('site.payment.index', $situation_id);
    }
}
