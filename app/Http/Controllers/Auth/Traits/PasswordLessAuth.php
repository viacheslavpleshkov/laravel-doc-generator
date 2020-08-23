<?php

namespace App\Http\Controllers\Auth\Traits;

use App\Models\LoginAttempt;
use App\Models\User;
use App\Notifications\NewLoginAttempt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Auth\RegisterController;

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
            $this->username() => 'required|email',
        ], $messages);

    }

    /**
     * @param Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\Response|void
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
        $user = User::where('email', $request->email)->first();
        if (!isset($user))
            (new RegisterController())->register($request);
        if ($this->createLoginAttempt($request)) {
            return $this->sendAttemptResponse($request);
        } else
            return $this->sendFailedLoginResponse($request);
    }
    /**
     * @param $token
     * @param Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login($token, Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponsee($request);
        }
        if ($this->attemptLogin($token, $request)) {
            return redirect($request->url);
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
            $this->guard()->login($user);
            return redirect($request->url);
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

        $authorize->notify(new NewLoginAttempt($authorize, $request->url));

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
