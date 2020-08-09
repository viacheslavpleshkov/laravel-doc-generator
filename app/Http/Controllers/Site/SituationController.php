<?php

namespace App\Http\Controllers\Site;

use App\Models\User_fill_input;
use App\Repositories\DocumentKeyRepository;
use App\Repositories\SituationRepository;
use Illuminate\Http\Request;
use App\Repositories\TypeRepository;
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
     * SiteController constructor.
     * @param TypeRepository $typeRepository
     * @param SituationRepository $situationRepository
     */
    public function __construct(SituationRepository $situationRepository, DocumentKeyRepository $documentKeyRepository)
    {
        $this->situationRepository = $situationRepository;
        $this->documentKeyRepository = $documentKeyRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $situation = $this->situationRepository->getById($id);

        if (isset($situation)) {
            $main = $this->documentKeyRepository->getSiteSituation($situation->id);
            $data = User_fill_input::where('user_id', Auth::user()->id)->where('situation_id', $situation->id)->get();

            if (!$data->isEmpty())
                return view('site.situation.situation-value', ['main' => $data, 'situation' => $situation->id]);
            else
                return view('site.situation.situation', ['main' => $main, 'situation' => $situation->id]);
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
            User_fill_input::create([
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
            User_fill_input::where('user_id', Auth::user()->id)
                ->where('document_id', $value)
                ->where('situation_id', $situation_id)->update([
                'user_input' => $array[$value],
            ]);
        }
        return redirect()->route('site.payment.index', $situation_id);
    }
}
