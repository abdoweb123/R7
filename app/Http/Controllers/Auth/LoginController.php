<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

//    use AuthenticatesUsers;

//    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /*** showLoginForm function ***/
    public function showLoginForm()
    {
        return view('auth.login');
    }



    /*** login function ***/
    public function login(LoginRequest $request){
       if (Auth::guard('company')->attempt(['company_email' => $request->email, 'password' => $request->password])) {
        return redirect()->to('dashboard');
        } else{
            return redirect()->back()->withInput(['email','password'])->with('alert-danger', 'يوجد خطا في كلمة المرور او اسم المستخدم أو النوع');
        }
    }



    /*** logout function ***/
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


} //end of class
