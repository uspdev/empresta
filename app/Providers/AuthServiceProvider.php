<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            $admins = explode(',', trim(env('SENHAUNICA_ADMINS')));
            return in_array($user->username, $admins);
        });

        Gate::define('balcao', function ($user) {
            if(Gate::allows('admin')) return true;
            $verifica = User::where('username', $user->username)->where('tipo', 'Balcao')->first();
            if($verifica){
                return true;
            }
        });
    }
}
