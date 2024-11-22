@extends('layouts.app')

@if($mode == 'edit')
@section('title', 'Edit Dokumentasi UKM | UKM Admin')
@else
@section('title', 'Buat Dokumentasi UKM | UKM Admin')
@endif

@section('body')
<main class="h-screen w-screen flex">
  <aside class="h-full w-80">
    @include('partials.club-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">{{ $mode == 'edit' ? 'Edit' : 'Buat' }} Dokumentasi UKM</h1>
    <div class="flex w-full mt-8 flex-row gap-x-12 justify-center">
      <div class="flex flex-col items-center py-6 w-full max-w-96">
        <form action="{{ $mode == 'edit' ? route('admin.club.documentation.edit', ['clubId' => $club->id, 'id' => $data->id]) : route('admin.club.documentation.create', ['clubId' => $club->id]) }}" enctype="multipart/form-data" method="post" class="flex flex-col items-center w-full">
          @csrf
          @if($mode == 'edit')
          @method('PUT')
          @endif
          <div class="w-full">
            <label for="title-input" class="block mb-2 text-sm font-medium text-neutral-900">Judul</label>
            <textarea rows="3" id="title-input" placeholder="Input judul dokumentasi" name="title" class="resize-none bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('title', $data->title ?? '') }}</textarea>
            @error('title')
            <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
            @enderror
          </div>
          <div class="w-full mt-4">
            <label for="image-input" class="block mb-2 text-sm font-medium text-neutral-900">Gambar Posting</label>
            <input aria-describedby="file_input_help" name="image" type="file" id="image-input" class="block w-full text-sm text-neutral-900 border border-neutral-300 rounded-lg cursor-pointer bg-neutral-50 focus:outline-none">
            @error('image')
            <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
            @enderror
          </div>
          <div class="w-full mt-4">
            <label for="date-input" class="block mb-2 text-sm font-medium text-neutral-900">Tanggal Perlombaan</label>
            <input value="{{ old('date', $data->date ?? now()->toDateString()) }}" name="date" type="date" id="date-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('date')
            <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
            @enderror
          </div>
          <div class="w-full mt-6">
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
          </div>
        </form>
      </div>
      <div class="flex flex-col w-full py-6 max-w-96">
        <p class="block mb-2 text-sm font-medium text-neutral-900">Preview Gambar</p>
        <div class="p-4 bg-white w-full h-full">
          @if($mode == 'create')
          <img id="image-preview" class="w-full" />
          @elseif($mode == 'edit')
          @if($data->image)
          <img id="image-preview" class="w-full" src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}" />
          @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</main>
<script type="module">
  const imageInputRef = document.getElementById("image-input");
  const imagePreviewRef = document.getElementById("image-preview");

  setupImagePreview(imageInputRef, imagePreviewRef);
</script>
@endsection