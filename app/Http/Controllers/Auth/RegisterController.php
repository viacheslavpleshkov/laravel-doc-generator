<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\Auth\LoginRequest;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends BaseController
{
    use RegistersUsers;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * RegisterController constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        $role = $this->roleRepository->getRoleUser();
        $attributes = [
            'email' => $data['email'],
            'role_id' => $role->id
        ];

        return $this->userRepository->create($attributes);
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(LoginRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')->with(['success' => 'Success! your account is registered.']);
    }
}
