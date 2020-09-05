<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\NewsStoreRequest;
use App\Http\Requests\Admin\NewsUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

/**
 * Class NewsController
 * @package App\Http\Controllers\Admin
 */
class NewsController extends BaseController
{
    /**
     * @var NewsRepository
     */
    protected $newsRepository;
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * NewsController constructor.
     * @param NewsRepository $newsRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(NewsRepository $newsRepository, SettingRepository $settingRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->newsRepository->getAdminAll($paginate);

        return view('admin.news.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * @param NewsStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsStoreRequest $request)
    {
        $category = $this->newsRepository->create($request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store news id= ' . $category->id . ' with params ', $request->all());

        return redirect()->route('news.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->newsRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show news id= ' . $main->id);

        return view('admin.news.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $main = $this->newsRepository->getById($id);

        return view('admin.news.edit', compact('main'));
    }

    /**
     * @param NewsUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsUpdateRequest $request, $id)
    {
        $this->newsRepository->update($id, $request->except(['url']));
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update news id= ' . $id . ' with params ', $request->all());

        return redirect()->route('news.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->newsRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy news id= ' . $id);

        return redirect()->route('news.index')->with('success', __('admin.information-deleted'));
    }
}