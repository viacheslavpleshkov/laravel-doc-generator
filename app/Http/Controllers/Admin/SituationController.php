<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SituationRepository;
use App\Repositories\TypeRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\SituationStoreRequest;
use App\Http\Requests\Admin\SituationUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class SituationController
 * @package App\Http\Controllers\Admin
 */
class SituationController extends BaseController
{
    /**
     * @var
     */
    protected $typeRepository;

    /**
     * @var SituationRepository
     */
    protected $situationRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * SituationController constructor.
     * @param TypeRepository $typeRepository
     * @param SituationRepository $situationRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(TypeRepository $typeRepository, SituationRepository $situationRepository,SettingRepository $settingRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->situationRepository = $situationRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->situationRepository->getAdminAll($paginate);

        return view('admin.situations.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = $this->typeRepository->getAll();

        return view('admin.situations.create', compact('types'));
    }

    /**
     * @param SituationStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SituationStoreRequest $request)
    {
        $main = $this->situationRepository->create($request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store situation id= ' . $main->id . ' with params ', $request->all());

        return redirect()->route('situations.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->situationRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show situation id= ' . $main->id);

        return view('admin.situations.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $types = $this->typeRepository->getAll();
        $main = $this->situationRepository->getById($id);

        return view('admin.situations.edit', compact('main', 'types'));
    }

    /**
     * @param SituationUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SituationUpdateRequest $request, $id)
    {
        $this->situationRepository->update($id, $request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update situation id= ' . $id . ' with params ', $request->all());

        return redirect()->route('situations.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->situationRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy situation id= ' . $id);

        return redirect()->route('situations.index')->with('success', __('admin.information-deleted'));
    }
}