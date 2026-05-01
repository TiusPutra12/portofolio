<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Bootstrap: Create default admin if no users exist
        if (User::count() === 0) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@portfolio.com',
                'password' => Hash::make(config('app.admin_password')),
            ]);
        }

        $user = User::first();

        if (Hash::check($request->password, $user->password)) {
            Auth::login($user, true); // Use remember me
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['password' => 'Password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}
