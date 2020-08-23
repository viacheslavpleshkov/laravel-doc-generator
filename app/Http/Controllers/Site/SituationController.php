<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Admin\TypeController;
use App\Repositories\DocumentKeyRepository;
use App\Repositories\SituationRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserFillInputRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use PhpParser\Node\Stmt\DeclareDeclare;

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
     * @var
     */
    protected $typeRepository;

    /**
     * SituationController constructor.
     * @param SituationRepository $situationRepository
     * @param DocumentKeyRepository $documentKeyRepository
     * @param UserFillInputRepository $userFillInputRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(SituationRepository $situationRepository,
                                DocumentKeyRepository $documentKeyRepository,
                                UserFillInputRepository $userFillInputRepository,
                                TypeRepository $typeRepository)
    {
        $this->situationRepository = $situationRepository;
        $this->documentKeyRepository = $documentKeyRepository;
        $this->userFillInputRepository = $userFillInputRepository;
        $this->typeRepository = $typeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $situation = $this->situationRepository->getById($request->situation_id);

        if (isset($situation)) {
            if (Auth::check())
                $user_id = Auth::user()->id;
            else
                $user_id = 0;
            $type = $this->typeRepository->getSiteUrl($request->type_url);
            $main = $this->documentKeyRepository->getSiteSituation($request->document_id);
            if (!$main->isEmpty()) {
                $data = $this->userFillInputRepository->getSiteSituation($user_id, $type->id);
                $title = mb_convert_case($main[0]->documentfile->title, MB_CASE_LOWER, "UTF-8");
                return view('site.situation.situation', [
                    'main' => $main,
                    'data' => $data,
                    'situation_id' => $situation->id,
                    'type_url' => $type->id,
                    'document_id' => $request->document_id,
                    'title' => $title
                ]);
            } else
                abort(404);
        } else
            abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function form(Request $request)
    {
        $situation_id = $request->situation_id;
        $array = $request->except('_token');
        if (Auth::check())
            $user_id = Auth::user()->id;
        else {
            $random = str_random(240).'@m.com';
            $user = (new RegisterController())->createGust(['email' => $random]);
            Auth::login($user, true);
            $user_id = $user->id;
        }

        foreach (array_keys($array) as $value) {
            $check = $this->userFillInputRepository
                ->getRepeatInput($user_id, $value);
            if (!$check->isEmpty()) {
                $this->userFillInputRepository
                    ->setUpdateUserInput($user_id, $value, $array[$value]);
                continue;
            }
            $this->userFillInputRepository
                ->setCreateUserInput($user_id, $situation_id, $value, $array[$value], $request->type_url);
        }

        return redirect()->route('site.payment.index', [
            'situation_id' => $request->situation_id,
            'type_url' => $request->type_url,
            'document_id' =>  $request->document_id
        ]);
    }
}
