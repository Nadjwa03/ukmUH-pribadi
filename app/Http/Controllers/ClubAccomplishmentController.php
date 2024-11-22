<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClubAccomplishment;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubAccomplishmentController extends Controller
{
    public function index(string $clubId)
    {
        $club = Club::findOrFail($clubId);

        $accomplishments = $club->accomplishments()->withTrashed()->orderBy('updated_at', 'desc')->get();

        return view('admin.club.accomplishment.index', ['club' => $club, 'accomplishments' => $accomplishments]);
    }

    public function view_create(string $clubId)
    {
        $club = Club::findOrFail($clubId);

        return view('admin.club.accomplishment.form', ['club' => $club, 'mode' => 'create']);
    }

    public function create(string $clubId, Request $request)
    {
        $club = Club::findOrFail($clubId);

        $request->validate([
            'title' => 'required|min:2',
            'date' => 'date',
            'image' => 'nullable|file|mimes:jpg,png,svg,webp|max:8192',
        ], [
            'title.required' => 'Judul prestasi tidak boleh kosong.',
            'title.min' => 'Judul prestasi minimal 2 karakter.',
            'image.file' => 'Gambar poster wajib merupakan file.',
            'image.mimes' => 'Gambar poster wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'image.max' => 'Ukuran gambar poster maksimum 4MB.'
        ]);

        if ($request->file('image')->isValid()) {
            $filePath = $request->file('image')->store('uploads', 'public');
            ClubAccomplishment::create([
                'title' => $request->title,
                'date' => $request->date,
                'image' => $filePath,
                'club_id' => $club->id,
            ]);
        }

        return redirect()->route('admin.club.accomplishment.index', ['clubId' => $club]);
    }

    public function view_edit(string $clubId, string $id)
    {
        $club = Club::findOrFail($clubId);

        $accomplishment = ClubAccomplishment::withTrashed()->find($id);

        return view('admin.club.accomplishment.form', ['club' => $club, 'mode' => 'edit', 'data' => $accomplishment]);
    }

    public function edit(string $clubId, string $id, Request $request)
    {
        $club = Club::findOrFail($clubId);

        $request->validate([
            'title' => 'required|min:2',
            'date' => 'date|before_or_equal:today',
            'image' => 'nullable|file|mimes:jpg,png,svg,webp|max:16384',
        ], [
            'title.required' => 'Judul prestasi tidak boleh kosong.',
            'title.min' => 'Judul prestasi minimal 2 karakter.',
            'date.date' => 'Format tanggal tidak tepat.',
            'date.before_or_equal' => 'Tanggal tidak melebihi tanggal hari ini.',
            'image.file' => 'Gambar poster wajib merupakan file.',
            'image.mimes' => 'Gambar poster wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'image.max' => 'Ukuran gambar poster maksimum 16MB.'
        ]);

        $accomplishment = ClubAccomplishment::withTrashed()->findOrFail($id);

        $data = [
            'title' => $request->title,
            'date' => $request->date,
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($accomplishment->logo) {
                Storage::disk('public')->delete($accomplishment->logo);
            }

            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $accomplishment->update($data);

        return redirect()->route('admin.club.accomplishment.index', ['clubId' => $club]);
    }

    public function deactivate(string $clubId, string $id)
    {
        $club = Club::findOrFail($clubId);

        $accomplishment = ClubAccomplishment::findOrFail($id);
        $accomplishment->delete();

        return redirect()->route('admin.club.accomplishment.index', ['clubId' => $club]);
    }

    public function activate(string $clubId, string $id)
    {
        $club = Club::findOrFail($clubId);

        $accomplishment = ClubAccomplishment::onlyTrashed()->findOrFail($id);
        $accomplishment->restore();

        return redirect()->route('admin.club.accomplishment.index', ['clubId' => $club]);
    }
}
