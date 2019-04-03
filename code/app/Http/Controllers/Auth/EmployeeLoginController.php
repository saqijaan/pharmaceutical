<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class EmployeeLoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm()
    {
        return view('auth.employee-login');
    }

    protected function guard(){
        return Auth::guard('employee');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/employee/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }

    protected function redirectTo(){
        return route('employee.home');
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
