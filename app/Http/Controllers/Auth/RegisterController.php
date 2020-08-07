<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

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
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->userRepository = new UserRepository;
        $this->roleRepository = new RoleRepository;
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')->with(['success' => 'Success! your account is registered.']);
    }
}
