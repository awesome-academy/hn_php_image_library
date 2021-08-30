<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        if ($user['role']) {
            return redirect(route('dashboard'));
        }

        return redirect(route('home.user', ['id' => $user['id']]));
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = array_merge($this->credentials($request), ['is_active' => config('project.is_active')]);

        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    protected function loggedOut()
    {
        return redirect()->back();
    }
}
