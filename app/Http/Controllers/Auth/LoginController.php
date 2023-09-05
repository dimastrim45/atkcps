<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;

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

    protected function authenticated(Request $request, $user)
    {
        if (auth()->user()->license === 'administrator') {
            return redirect(RouteServiceProvider::HOME);
        } else  if (auth()->user()->license === 'staff'){
            return redirect(RouteServiceProvider::HOME);
        } else  if (auth()->user()->license === 'hradmin'){
            return redirect(RouteServiceProvider::HOME);
        } else  if (auth()->user()->license === 'manager'){
            return redirect(RouteServiceProvider::NEWITEMADMIN);
        } else {
            return redirect()->intended('/');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // Override the redirectTo property
    protected function redirectTo()
    {
        if (auth()->user()->license === 'administrator') {
            return redirect(RouteServiceProvider::HOME);
        } else  if (auth()->user()->license === 'staff'){ 
            return redirect(RouteServiceProvider::HOME);
        } else  if (auth()->user()->license === 'hradmin'){
            return redirect(RouteServiceProvider::HOME);
        } else  if (auth()->user()->license === 'manager'){
            return redirect(RouteServiceProvider::NEWITEMADMIN);
        } else {
            return redirect()->intended('/');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
