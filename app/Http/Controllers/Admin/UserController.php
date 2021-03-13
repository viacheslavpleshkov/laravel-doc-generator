<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserFillInputRepository;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends BaseController
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;
    /**
     * @var RoleRepository
     */
    protected $roleRepository;
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var DocumentKeyRepository
     */
    protected $userFillInputRepository;

    /**
     * UserController constructor.
     * @param SettingRepository $settingRepository
     * @param RoleRepository $roleRepository
     * @param UserRepository $userRepository
     * @param UserFillInputRepository $userFillInputRepository
     */
    public function __construct(SettingRepository $settingRepository, RoleRepository $roleRepository, UserRepository $userRepository, UserFillInputRepository $userFillInputRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->userFillInputRepository = $userFillInputRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->userRepository->getUserAdminAll($paginate);

        return view('admin.users.index', compact('main'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $role = $this->roleRepository->getAll();

        return view('admin.users.create', compact('role'));
    }

    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $attributes = [
            'email' => $request->email,
            'role_id' => $request->role_id
        ];
        $user = $this->userRepository->create($attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') store user id= ' . $user->id . ' with params ', $request->all());


        return redirect()->route('users.index')->with('success', __('admin.created-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->userRepository->getById($id);
        $userFillInputRepository = $this->userFillInputRepository->getAdminValueUser($main->id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show user id= ' . $main->id);

        return view('admin.users.show', compact('main', 'userFillInputRepository'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getAll();
        $main = $this->userRepository->getById($id);

        return view('admin.users.edit', compact('main', 'role'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $attributes = [
            'email' => $request->email,
            'role_id' => $request->role_id
        ];
        $this->userRepository->update($id, $attributes);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') update user id= ' . $id . ' with params ', $request->all());

        return redirect()->route('users.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy user id= ' . $id);

        return redirect()->route('users.index')->with('success', __('admin.information-deleted'));
    }
}