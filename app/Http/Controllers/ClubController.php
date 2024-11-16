<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::withTrashed()->get();

        return view('admin.club.index', ['clubs' => $clubs]);
    }

    public function view_create()
    {
        return view('admin.club.form', ['mode' => 'create']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'logo' => 'nullable|file|mimes:jpg,png,svg,webp|max:8192',
        ], [
            'name.required' => 'Nama UKM tidak boleh kosong.',
            'name.min' => 'Nama UKM minimal 2 karakter.',
            'logo.file' => 'Logo UKM wajib merupakan file.',
            'logo.mimes' => 'Logo UKM wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'logo.max' => 'Ukuran file logo UKM maksimum 8MB.'
        ]);

        if ($request->file('logo')->isValid()) {
            $filePath = $request->file('logo')->store('uploads', 'public');
            Club::create([
                'name' => $request->name,
                'logo' => $filePath,
                'history' => $request->history,
                'about' => $request->about,
            ]);
        }


        return redirect()->route('admin.club.index');
    }

    public function view_edit(string $id)
    {
        $club = Club::withTrashed()->find($id);

        return view('admin.club.form', ['mode' => 'edit', 'data' => $club]);
    }

    public function edit(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'logo' => 'nullable|file|mimes:jpg,png,svg,webp|max:8192',
        ], [
            'name.required' => 'Nama UKM tidak boleh kosong.',
            'name.min' => 'Nama UKM minimal 2 karakter.',
            'logo.file' => 'Logo UKM wajib merupakan file.',
            'logo.mimes' => 'Logo UKM wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'logo.max' => 'Ukuran file logo UKM maksimum 8MB.'
        ]);

        $club = Club::withTrashed()->findOrFail($id);

        $data = [
            'name' => $request->name,
            'history' => $request->history,
            'about' => $request->about,
        ];

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            if ($club->logo) {
                Storage::disk('public')->delete($club->logo);
            }

            $data['logo'] = $request->file('logo')->store('uploads', 'public');
        }

        $club->update($data);

        return redirect()->route('admin.club.index');
    }

    public function deactivate(string $id)
    {
        $club = Club::findOrFail($id);
        $club->delete();

        return redirect()->route('admin.club.index');
    }

    public function activate(string $id)
    {
        $club = Club::onlyTrashed()->findOrFail($id);
        $club->restore();

        return redirect()->route('admin.club.index');
    }

    public function details(string $id)
    {
        $club = Club::withTrashed()->findOrFail($id);

        return view('admin.club.details', ['club' => $club]);
    }
}
