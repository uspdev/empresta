<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class LoginInternController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function index(){
        return view('welcome');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

}
