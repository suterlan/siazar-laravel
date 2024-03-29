<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login | '. config('app.name'),
            'sekolah'   => Sekolah::first()
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // if (auth()->user()->role_id === 4) {
            if (auth()->user()->role->name === 'siswa') {
                return redirect()->intended('/dashboard-siswa');
            }else{
                return redirect()->intended('/dashboard');
            }
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
