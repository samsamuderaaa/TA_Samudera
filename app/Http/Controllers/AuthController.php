<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\File;
use App\Models\User;


class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->with('error', 'Login Gagal');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard(Request $request)
    {
        $users = DB::table('users')->get();
        return view('dashboard', ['users' => $users]);
    }

    public function proseshapus($idUser)
    {
        $user = User::where('id', $idUser)->first()->delete();
        return redirect('admin');
    }
}
