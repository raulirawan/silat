<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        // cek mengandung jakarta.go.id
        // $email = $request->email;
        // if (strpos($email, '@jakarta.go.id')) {
        //     // bikin user baru
        //     $user = User::where('email', $email)->first();
        //     if ($user == null) {
        //         $newUser = new User();
        //         $newUser->email = $email;
        //         $newUser->roles = 'PEGAWAI';
        //         $newUser->save();

        //         Session::put('email', $newUser->email);
        //     } else {
        //         Session::put('email', $user->email);
        //     }
        //     return redirect()->route('admin.dashboard.index');
        // }
        // return redirect()->route('login')->with('error', 'Email Tidak Valid!');

        $email = $request->email;
        // bikin user baru
        $user = User::where('email', $email)->first();
        if ($user != null) {

            Session::put('email', $user->email);
            return redirect()->route('admin.dashboard.index');
        }
        return redirect()->route('login')->with('error', 'Email Tidak Valid!');
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('login');
    }
}
    