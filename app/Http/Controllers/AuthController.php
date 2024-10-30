<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // https://laravel.com/docs/11.x/validation#available-validation-rules
        // proses data login yang dikirimkan melalui form dengan HTTP method POST.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            // 'namaKey.namaRule'
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email salah',
            'password.required' => 'Password wajib diisi'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            // Jika tidak sukses
            // Gagal login umumnya krn 2 hal, email gk ada di database atau password salah.
            return redirect()->route('admin.auth.view_login')->withErrors([
                'email' => 'Email atau password salah',
                'password' => 'Email atau password salah',
            ]);
        }

        return redirect()->route('admin.index');
    }
}
