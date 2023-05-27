<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    protected $redirectTo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $role = Auth::user()->roles->first();

        if (Auth::user()->hasRole('admin')) {
            $this->redirectTo = RouteServiceProvider::HOME;
            return redirect()->route('admin.halamanutama.index');
        } elseif (Auth::user()->hasRole('mahasiswa')) {
            $this->redirectTo = RouteServiceProvider::SiswaDashboard;
            return redirect()->route('siswa.halamanutama.index');
        } elseif (Auth::user()->hasRole('pegawai')) {
            $this->redirectTo = RouteServiceProvider::PegawaiDashboard;
            return redirect()->route('pegawai.halamanutama.index');
        } elseif (Auth::user()->hasRole('dosen')) {
            $this->redirectTo = RouteServiceProvider::GuruDashboard;
            return redirect()->route('guru.halamanutama.index');
        }
        elseif (Auth::user()->hasRole('perpustakaan')) {
            $this->redirectTo = RouteServiceProvider::PerpustakaanDashboard;
            return redirect()->route('perpustakaan.halamanutama.index');
        }
    }
}
