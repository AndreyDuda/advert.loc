<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Entity\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LoginController extends Controller
{
    use ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $authenticate = Auth::attempt(
            $request->only(['email', 'password']),
            $request->filled('remember')
        );

        if ($authenticate) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            $user = Auth::user();
            if (!$user->status !== User::STATUS_ACTIVE) {
                Auth::logout();
                return back()->with('error', 'You need to confirm your account. Please check your email.');
            }
            return redirect()->intended(route('cabinet'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }

   /* public function authenticated(Request $request, $user)
    {
        if (!$user->status !== User::STATUS_ACTIVE) {
            $this->guard()->logout();
            return back()->with('error', 'You need to confirm your account. Please your email.');
        }
        return redirect()->intended($this->redirectPath());
    }*/

    protected function username()
    {
        return 'name';
    }



}
