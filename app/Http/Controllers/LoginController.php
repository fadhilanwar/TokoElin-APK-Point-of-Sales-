<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(){
        return view('index');
        }

    public function aksilogin(Request $request)
    {
        $login = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($login)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
             
                $request->session()->put('user', $user);

                // DB::statement('CALL log_history_add(?, ?, ?, ?, ?)', [
                //     $user->id,
                //     $user->name,
                //     $user->role,
                //     'Logged-In',
                //     now(),
                // ]);
                $word = 'Welcome back, ' . $user->name;
                $request->session()->regenerate();
                alert()->success('Berhasil Login !', $word);

                return redirect()->intended('/dashboard');

            } else{

                $request->session()->put('user', $user);

                DB::statement('CALL log_history_add(?, ?, ?, ?, ?)', [
                    $user->id,
                    $user->name,
                    $user->role,
                    'Logged-In',
                    now(),
                ]);

             
                $request->session()->regenerate();
                return redirect()->intended('/main-kasir');
            }

        }else {

            return back()->with('Login Gagal', 'Periksa Kembali Username / Password !');

        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }
}
