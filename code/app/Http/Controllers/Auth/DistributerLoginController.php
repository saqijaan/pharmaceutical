<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class DistributerLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm()
    {
        return view('auth.distributer-login');
    }

    protected function guard(){
        return Auth::guard('distributer');
    }

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/distributer-order-book';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:distributer')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $impersontateId = Session::has('impersonate') ? Session::get('impersonate') : -1;  
        $request->session()->invalidate();
        if ($impersontateId>=0 ){
            Auth::loginUsingId(
                $impersontateId
            );
            return redirect('/login');
        }
        return $this->loggedOut($request) ?: redirect('/');
    }
}
