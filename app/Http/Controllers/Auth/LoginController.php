<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $role = Auth::user()->roles->first();

        if (Auth::user()->hasRole('admin')) {
            $this->redirectTo = RouteServiceProvider::HOME;
            return $this->redirectTo;
        } elseif (Auth::user()->hasRole('siswa')) {
            $this->redirectTo = RouteServiceProvider::SiswaDashboard;
            return $this->redirectTo;
        } elseif (Auth::user()->hasRole('pegawai')) {
            $this->redirectTo = RouteServiceProvider::PegawaiDashboard;
            return $this->redirectTo;
        } elseif (Auth::user()->hasRole('dosen')) {
            $this->redirectTo = RouteServiceProvider::GuruDashboard;
            return $this->redirectTo;
        }
        elseif (Auth::user()->hasRole('perpustakaan')) {
            $this->redirectTo = RouteServiceProvider::PerpustakaanDashboard;
            return $this->redirectTo;
        }
    }
}
