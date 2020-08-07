<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DocumentFileRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\DocumentStoreRequest;
use App\Http\Requests\Admin\DocumentUpdateRequest;
use Illuminate\Http\Request;
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
     * @param SettingRepository $settingRepository
     */
    public function __construct(DocumentRepository $documentRepository, DocumentFileRepository $documentFileRepository, SettingRepository $settingRepository)
    {
        $this->documentRepository = $documentRepository;
        $this->documentFileRepository = $documentFileRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param $document
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($document)
    {
        $document_file = $this->documentFileRepository->getById($document);
        if (isset($document_file)) {
            $paginate = $this->settingRepository->getPaginateAdmin();
            $main = $this->documentRepository->getAdminAll($document, $paginate);

            return view('admin.documents-keys.index', ['main' => $main, 'name' => $document_file->file_path, 'document' => $document]);
        } else
            abort(404);
    }

    /**
     * @param $document
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($document)
    {
        return view('admin.documents-keys.create', compact('document'));
    }

    /**
     * @param DocumentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentStoreRequest $request)
    {
        $attributes = [
            'title' => $request->title,
            'key' => $request->key,
            'document_file_id' => $request->document
        ];

        $category = $this->documentRepository->create($attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store type id= ' . $category->id . ' with params ', $request->all());

        return redirect()->route('documents-keys.index', $request->document)->with('success', __('admin.created-success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $main = $this->documentRepository->getById($request->id);
        $document = $request->document;
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show type id= ' . $main->id);

        return view('admin.documents-keys.show', compact('main', 'document'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $main = $this->documentRepository->getById($request->id);
        $document = $request->document;

        return view('admin.documents-keys.edit', compact('main', 'document'));
    }

    /**
     * @param DocumentUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentUpdateRequest $request)
    {
        $attributes = [
            'title' => $request->title,
            'key' => $request->key,
            'document_file_id' => $request->document
        ];

        $this->documentRepository->update($request->id, $attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update document id= ' . $request->id . ' with params ', $request->all());

        return redirect()->route('documents-keys.index', $request->document)->with('success', __('admin.updated-success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->documentRepository->delete($request->id);
        $document = $request->document;
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy document id= ' . $request->id);

        return redirect()->route('documents-keys.index', $document)->with('success', __('admin.information-deleted'));
    }
}