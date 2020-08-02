<?php

namespace App\Http\Controllers\Auth\Traits;

use App\Models\LoginAttempt;
use App\Notifications\NewLoginAttempt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Trait PasswordLessAuth
 * @package App\Http\Controllers\Auth\Traits
 */
trait PasswordLessAuth
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $messages = ['exists' => trans('auth.exists')];

        $this->validate($request, [
            $this->username() => 'required|email|exists:users',
        ], $messages);
    }

    /**
     * Handle a login attempt request to the application.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function attempt(Request $request)
    {
        $this->incrementLoginAttempts($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->validateLogin($request);

        if ($this->createLoginAttempt($request)) {
            return $this->sendAttemptResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Handle a login request to the application.
     * @param $token
     * @param Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login($token, Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($token, $request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     * @param $token
     * @param Request $request
     */
    protected function attemptLogin($token, Request $request)
    {
        $user = LoginAttempt::userFromToken($token);

        if (is_object($user)) {
            return $this->guard()->login($user);
        }
    }

    /**
     * Attempt to log the user into the application.
     * @param Request $request
     * @return mixed
     */
    protected function createLoginAttempt(Request $request)
    {
        $authorize = LoginAttempt::create([
            'email' => $request->input($this->username()),
            'token' => Str::random(40) . time(),
        ]);

        $authorize->notify(new NewLoginAttempt($authorize));

        return $authorize;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function sendAttemptResponse($request)
    {
        return \View::make('auth._link-sent');
    }
}
