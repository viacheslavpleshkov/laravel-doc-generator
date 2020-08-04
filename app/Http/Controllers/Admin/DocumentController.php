<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DocumentFileRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\DocumentStoreRequest;
use App\Http\Requests\Admin\DocumentUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class DocumentController
 * @package App\Http\Controllers\Admin
 */
class DocumentController extends BaseController
{
    /**
     * @var DocumentRepository
     */
    protected $documentRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var DocumentFileRepository
     */
    protected $documentFileRepository;

    /**
     * DocumentController constructor.
     * @param DocumentRepository $documentRepository
     * @param DocumentFileRepository $documentFileRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(DocumentRepository $documentRepository, DocumentFileRepository $documentFileRepository,SettingRepository $settingRepository)
    {
        $this->documentRepository = $documentRepository;
        $this->documentFileRepository = $documentFileRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->documentRepository->getAdminAll($paginate);

        return view('admin.documents.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $main = $this->documentFileRepository->getAll();

        return view('admin.documents.create', compact('main'));
    }

    /**
     * @param DocumentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentStoreRequest $request)
    {
        $category = $this->documentRepository->create($request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store type id= ' . $category->id . ' with params ', $request->all());

        return redirect()->route('documents.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->documentRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show type id= ' . $main->id);

        return view('admin.documents.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $main = $this->documentRepository->getById($id);
        $documents = $this->documentFileRepository->getAll();

        return view('admin.documents.edit', compact('main', 'documents'));
    }

    /**
     * @param DocumentUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentUpdateRequest $request, $id)
    {
        $this->documentRepository->update($id, $request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update document id= ' . $id . ' with params ', $request->all());

        return redirect()->route('documents.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->documentRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy document id= ' . $id);

        return redirect()->route('documents.index')->with('success', __('admin.information-deleted'));
    }
}