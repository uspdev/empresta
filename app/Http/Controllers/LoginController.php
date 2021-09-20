<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
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

    public function redirectToProvider()
    {
        return Socialite::driver('senhaunica')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $userSenhaUnica = Socialite::driver('senhaunica')->user();
        $user = User::where('username',$userSenhaUnica->codpes)->first();
        if (is_null($user)) $user = new User;

        // precisamos saber se o usuário é autorizado
        $admins = explode(',', trim(config('empresta.admins')));
        if ($admins) {
            $login = false;
            foreach ($admins as $admin) {
                if($userSenhaUnica->codpes == $admin) {
                    $login = true;
                }
            }
        }

        if (!$login) {
            $request->session()->flash('alert-danger', 'Usuário sem acesso ao sistema.');
            return redirect('/');
        }

        // bind do dados retornados
        $user->username = $userSenhaUnica->codpes;
        $user->email = $userSenhaUnica->email;
        $user->name = $userSenhaUnica->nompes;
        $user->tipo = 'Administrador';
        $user->save();

        Auth::login($user, true);
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

}
