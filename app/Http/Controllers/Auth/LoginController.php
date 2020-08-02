<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Traits;

class LoginController extends BaseController
{
    use Traits\PasswordLessAuth;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
