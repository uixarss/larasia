<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addDays(30));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        // Gate::define('manage-users', function($user){
        //   return $user->hasAnyRoles(['admin']);
        // });

        // Gate::define('view-pegawai', function($user){
        //   return $user->hasAnyRoles(['pegawai']);
        // });

        // Gate::define('view-guru', function($user){
        //   return $user->hasAnyRoles(['guru']);
        // });

        // Gate::define('view-siswa', function($user){
        //   return $user->hasAnyRoles(['siswa']);
        // });

        // Gate::define('manage-siswa', function($user){
        //   return $user->hasAnyRoles(['siswa']);
        // });

        // Gate::define('edit-users', function($user){
        //   return $user->hasAnyRoles(['admin', 'pegawai']);
        // });

        // Gate::define('delete-users', function($user){
        //   return $user->hasRole('admin');
        // });

        // Gate::define('view-walikelas', function($user){
        //   return $user->hasAnyRoles(['walikelas']);
        // });

        // Gate::define('view-perpustakaan', function($user){
        //   return $user->hasAnyRoles(['perpustakaan']);
        // });
    }
}
