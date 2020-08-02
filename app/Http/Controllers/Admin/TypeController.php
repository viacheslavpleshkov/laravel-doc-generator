<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TypeRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\TypeStoreRequest;
use App\Http\Requests\Admin\TypeUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class TypeController
 * @package App\Http\Controllers\Admin
 */
class TypeController extends BaseController
{
    /**
     * @var TypeRepository
     */
    protected $typeRepository;
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * TypeController constructor.
     * @param TypeRepository $typeRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(TypeRepository $typeRepository, SettingRepository $settingRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->typeRepository->getAdminAll($paginate);

        return view('admin.types.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * @param TypeStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TypeStoreRequest $request)
    {
        $category = $this->typeRepository->create($request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store type id= ' . $category->id . ' with params ', $request->all());

        return redirect()->route('types.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->typeRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show type id= ' . $main->id);

        return view('admin.types.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $main = $this->typeRepository->getById($id);

        return view('admin.types.edit', compact('main'));
    }

    /**
     * @param TypeUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TypeUpdateRequest $request, $id)
    {
        $this->typeRepository->update($id, $request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update type id= ' . $id . ' with params ', $request->all());

        return redirect()->route('types.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->typeRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy type id= ' . $id);

        return redirect()->route('types.index')->with('success', __('admin.information-deleted'));
    }
}