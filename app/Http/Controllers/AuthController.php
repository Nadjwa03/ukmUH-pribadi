<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email salah',
            'password.required' => 'Password wajib diisi'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($credentials['email'] == $credentials['password']) {
                return redirect()->route('admin.view_change_password');
            }

            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.club.details', ['id' => $user->club_id]);
            }

            return redirect()->intended(route('admin.index'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
            'password' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function view_change_password()
    {
        return view('admin.change_password');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8'
        ], [
            'old_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru wajib minimal 8 karakter'
        ]);

        $user = User::withTrashed()->findOrFail(Auth::user()->id);

        $user->update([
            'password' => Hash::make($request->new_password),
            'is_verified' => true
        ]);

        if ($user->role == 'admin') {
            return redirect()->intended(route('admin.club.details', ['id' => $user->club_id]));
        }

        return redirect()->intended(route('admin.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
