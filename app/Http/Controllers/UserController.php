<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->with('club')->get();

        return view('admin.user.index', ['users' => $users]);
    }

    public function view_create()
    {
        $clubs = Club::all();

        return view('admin.user.form', ['mode' => 'create', 'clubs' => $clubs]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:admin,superadmin',
            'club' => 'required_if:role,admin|exists:clubs,id'
        ], [
            'name.required' => 'Nama user tidak boleh kosong.',
            'name.min' => 'Nama user minimal 2 karakter.',
            'email.min' => 'Email user tidak boleh kosong.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah terdaftar.',
            'role.required' => 'Role user tidak boleh kosong.',
            'role.in' => 'Role user harus antara admin atau superadmin.',
            'club.required_if' => 'UKM wajib diplih',
            'club.exists' => 'UKM tidak ada.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'role' => $request->role,
            'club_id' => $request->role == 'admin' ? ($request->club  ?? null) : null,
        ]);

        return redirect()->route('admin.user.index');
    }

    public function view_edit(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $clubs = Club::all();

        return view('admin.user.form', ['mode' => 'edit', 'data' => $user, 'clubs' => $clubs]);
    }

    public function edit(Request $request, string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,superadmin',
            'club' => 'required_if:role,admin|exists:clubs,id'
        ], [
            'name.required' => 'Nama user tidak boleh kosong.',
            'name.min' => 'Nama user minimal 2 karakter.',
            'email.min' => 'Email user tidak boleh kosong.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah terdaftar.',
            'role.required' => 'Role user tidak boleh kosong.',
            'role.in' => 'Role user harus antara admin atau superadmin.',
            'club.required_if' => 'UKM wajib diplih',
            'club.exists' => 'UKM tidak ada.',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'club_id' => $request->role == 'admin' ? ($request->club  ?? null) : null,
        ]);

        return redirect()->route('admin.user.index');
    }

    public function deactivate(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index');
    }

    public function activate(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.user.index');
    }

    public function reset_password(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->update([
            'password' => Hash::make($user->email),
            'is_verified' => false
        ]);

        return redirect()->route('admin.user.index');
    }
}
