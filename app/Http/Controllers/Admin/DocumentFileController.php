<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DocumentFileRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\DocumentFileStoreRequest;
use App\Http\Requests\Admin\DocumentFileUpdateRequest;
use App\Repositories\SituationRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class DocumentFileController
 * @package App\Http\Controllers\Admin
 */
class DocumentFileController extends BaseController
{
    /**
     * @var DocumentFileRepository
     */
    protected $documentFileRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;
    /**
     * @var
     */
    protected $situationRepository;

    /**
     * DocumentFileController constructor.
     * @param DocumentFileRepository $documentFileRepository
     * @param SettingRepository $settingRepository
     * @param SituationRepository $situationRepository
     */
    public function __construct(DocumentFileRepository $documentFileRepository,
                                SettingRepository $settingRepository,
                                SituationRepository $situationRepository)
    {
        $this->documentFileRepository = $documentFileRepository;
        $this->settingRepository = $settingRepository;
        $this->situationRepository = $situationRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->documentFileRepository->getAdminAll($paginate);

        return view('admin.documents-files.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $main = $this->situationRepository->getAll();

        return view('admin.documents-files.create',compact('main'));
    }

    /**
     * @param DocumentFileStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentFileStoreRequest $request)
    {
        $attributes = [
            'title' => $request->title,
            'file_path' => Storage::disk()->put('docx', $request->file_path),
            'situation_id' => $request->situation_id,
            'price' => $request->price,
        ];
        $main = $this->documentFileRepository->create($attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store documents-keys-files id= ' . $main->id . ' with params ', $request->all());

        return redirect()->route('documents-files.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->documentFileRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show documents-keys-files id= ' . $main->id);

        return view('admin.documents-files.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $main = $this->documentFileRepository->getById($id);

        return view('admin.documents-files.edit', compact('main'));
    }

    /**
     * @param DocumentFileUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentFileUpdateRequest $request, $id)
    {
        $attributes = [
            'title' => $request->title,
            'price' => $request->price,
        ];

        $this->documentFileRepository->update($id, $attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update documents-keys-files id= ' . $request->id . ' with params ', $request->all());

        return redirect()->route('documents-files.index')->with('success', __('admin.updated-success'));
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = $this->documentFileRepository->getById($id);
        if(\File::exists(public_path($item->file_path))){
            \File::delete(public_path($item->file_path));
        }
        $this->documentFileRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy documents-keys-files id= ' . $id);

        return redirect()->route('documents-files.index')->with('success', __('admin.information-deleted'));
    }
}