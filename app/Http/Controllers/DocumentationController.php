<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    public function index()
    {
        $documentations = Documentation::withTrashed()->orderBy('updated_at', 'desc')->get();

        return view('admin.documentation.index', ['documentations' => $documentations]);
    }

    public function view_create()
    {
        return view('admin.documentation.form', ['mode' => 'create']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'date' => 'date',
            'image' => 'nullable|file|mimes:jpg,png,svg,webp|max:8192',
        ], [
            'title.required' => 'Nama UKM tidak boleh kosong.',
            'title.min' => 'Nama UKM minimal 2 karakter.',
            'image.file' => 'Gambar poster wajib merupakan file.',
            'image.mimes' => 'Gambar poster wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'image.max' => 'Ukuran gambar poster maksimum 4MB.'
        ]);

        if ($request->file('image')->isValid()) {
            $filePath = $request->file('image')->store('uploads', 'public');
            Documentation::create([
                'title' => $request->title,
                'date' => $request->date,
                'image' => $filePath,
            ]);
        }


        return redirect()->route('admin.documentation.index');
    }

    public function view_edit(string $id)
    {
        $documentation = Documentation::withTrashed()->find($id);

        return view('admin.documentation.form', ['mode' => 'edit', 'data' => $documentation]);
    }

    public function edit(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:2',
            'date' => 'date|before_or_equal:today',
            'image' => 'nullable|file|mimes:jpg,png,svg,webp|max:16384',
        ], [
            'title.required' => 'Nama UKM tidak boleh kosong.',
            'title.min' => 'Nama UKM minimal 2 karakter.',
            'date.date' => 'Format tanggal tidak tepat.',
            'date.before_or_equal' => 'Tanggal tidak melebihi tanggal hari ini.',
            'image.file' => 'Gambar poster wajib merupakan file.',
            'image.mimes' => 'Gambar poster wajib berekstensi JPG, PNG, WEBP, atau SVG.',
            'image.max' => 'Ukuran gambar poster maksimum 16MB.'
        ]);

        $documentation = Documentation::withTrashed()->findOrFail($id);

        $data = [
            'title' => $request->title,
            'date' => $request->date,
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($documentation->logo) {
                Storage::disk('public')->delete($documentation->logo);
            }

            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $documentation->update($data);

        return redirect()->route('admin.documentation.index');
    }

    public function deactivate(string $id)
    {
        $documentation = Documentation::findOrFail($id);
        $documentation->delete();

        return redirect()->route('admin.documentation.index');
    }

    public function activate(string $id)
    {
        $documentation = Documentation::onlyTrashed()->findOrFail($id);
        $documentation->restore();

        return redirect()->route('admin.documentation.index');
    }
}
