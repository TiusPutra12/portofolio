<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (session('admin_authenticated')) {
            return redirect('/admin');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if ($request->password === config('app.admin_password')) {
            session(['admin_authenticated' => true]);
            return redirect('/admin');
        }

        return back()->withErrors(['password' => 'Password salah.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        return redirect('/');
    }
}
