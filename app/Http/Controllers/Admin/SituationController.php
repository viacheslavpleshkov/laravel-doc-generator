<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SituationRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\SituationStoreRequest;
use App\Http\Requests\Admin\SituationUpdateRequest;
use Illuminate\Support\Facades\Storage;
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
        $seo = $this->seoRepository->getStatusAll();
        $categories = $this->categoryRepository->getStatusAll();

        return view('admin.articles.create', compact('seo', 'categories'));
    }

    /**
     * @param ArticleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SituationStoreRequest $request)
    {
        $attributes = [
            'title' => $request->title,
            'url' => $request->url,
            'images' => Storage::disk()->put('articles', $request->images),
            'text' => $request->text,
            'category_id' => $request->category_id,
            'seo_id' => $request->seo_id,
            'views' => $request->views,
            'slide' => $request->slide,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ];
        $main = $this->articleRepository->create($attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store article     id= ' . $main->id . ' with params ', $request->all());

        return redirect()->route('articles.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->articleRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show article id= ' . $main->id);

        return view('admin.articles.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $main = $this->articleRepository->getById($id);
        $seo = $this->seoRepository->getStatusAll();
        $categories = $this->categoryRepository->getStatusAll();
        $users = $this->userRepository->getAll();

        return view('admin.articles.edit', compact('main', 'categories', 'seo', 'users'));
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SituationUpdateRequest $request, $id)
    {
        $this->articleRepository->update($id, $request->except(['url', 'images']));
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update article id= ' . $id . ' with params ', $request->all());

        return redirect()->route('articles.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->articleRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy article id= ' . $id);

        return redirect()->route('articles.index')->with('success', __('admin.information-deleted'));
    }
}