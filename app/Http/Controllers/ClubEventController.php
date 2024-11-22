<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClubEvent;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubEventController extends Controller
{
    public function index(string $clubId)
    {
        $club = Club::findOrFail($clubId);

        $events = $club->events()->withTrashed()->orderBy('updated_at', 'desc')->get();

        return view('admin.club.event.index', ['club' => $club, 'events' => $events]);
    }

    public function view_create(string $clubId)
    {
        $club = Club::findOrFail($clubId);

        return view('admin.club.event.form', ['club' => $club, 'mode' => 'create']);
    }

    public function create(string $clubId, Request $request)
    {
        $club = Club::findOrFail($clubId);

        $request->validate([
            'image' => 'nullable|file|mimes:jpg,png,svg,webp|max:8192',
        ], [
            'image.file' => 'Gambar poster wajib merupakan file.',
            'image.mimes' => 'Gambar poster wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'image.max' => 'Ukuran gambar poster maksimum 4MB.'
        ]);

        if ($request->file('image')->isValid()) {
            $filePath = $request->file('image')->store('uploads', 'public');
            ClubEvent::create([
                'image' => $filePath,
                'club_id' => $club->id,
            ]);
        }

        return redirect()->route('admin.club.event.index', ['clubId' => $club]);
    }

    public function view_edit(string $clubId, string $id)
    {
        $club = Club::findOrFail($clubId);

        $event = ClubEvent::withTrashed()->find($id);

        return view('admin.club.event.form', ['club' => $club, 'mode' => 'edit', 'data' => $event]);
    }

    public function edit(string $clubId, string $id, Request $request)
    {
        $club = Club::findOrFail($clubId);

        $request->validate([
            'image' => 'nullable|file|mimes:jpg,png,svg,webp|max:16384',
        ], [
            'image.file' => 'Gambar poster wajib merupakan file.',
            'image.mimes' => 'Gambar poster wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'image.max' => 'Ukuran gambar poster maksimum 16MB.'
        ]);

        $event = ClubEvent::withTrashed()->findOrFail($id);


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($event->logo) {
                Storage::disk('public')->delete($event->logo);
            }

            $data = [
                'image' => $request->file('image')->store('uploads', 'public')
            ];

            $event->update($data);
        }


        return redirect()->route('admin.club.event.index', ['clubId' => $club]);
    }

    public function deactivate(string $clubId, string $id)
    {
        $club = Club::findOrFail($clubId);

        $event = ClubEvent::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.club.event.index', ['clubId' => $club]);
    }

    public function activate(string $clubId, string $id)
    {
        $club = Club::findOrFail($clubId);

        $event = ClubEvent::onlyTrashed()->findOrFail($id);
        $event->restore();

        return redirect()->route('admin.club.event.index', ['clubId' => $club]);
    }
}
