@extends('layouts.app')

@if($mode == 'edit')
@section('title', 'Edit UKM | UKM Admin')
@else
@section('title', 'Buat UKM | UKM Admin')
@endif

@section('body')
<main class="h-screen w-screen flex">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">{{ $mode == 'edit' ? 'Edit' : 'Buat' }} UKM</h1>
    <div class="flex flex-col items-center px-6 py-6">
      <form action="{{ $mode == 'edit' ? route('admin.club.edit', $data->id) : route('admin.club.create') }}" enctype="multipart/form-data" method="post" class="flex flex-col items-center max-w-96 w-full">
        @csrf
        @if($mode == 'edit')
        @method('PUT')
        @endif
        <div class="w-full mt-8">
          <label for="name-input" class="block mb-2 text-sm font-medium text-neutral-900">Name</label>
          <input value="{{ old('name', $data->name ?? '') }}" name="name" type="text" id="name-input" placeholder="Input nama UKM" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          @error('name')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-4">
          <label for="logo-input" class="block mb-2 text-sm font-medium text-neutral-900">Logo</label>
          <input aria-describedby="file_input_help" name="logo" type="file" id="logo-input" class="block w-full text-sm text-neutral-900 border border-neutral-300 rounded-lg cursor-pointer bg-neutral-50 focus:outline-none">
          @error('logo')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-4">
          <label for="about-input" class="block mb-2 text-sm font-medium text-neutral-900">Tentang UKM</label>
          <textarea id="about-input" name="about" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan deskripsi singkat tentang UKM ini...">{{ old('about', $data->about ?? '') }}</textarea>
        </div>
        <div class="w-full mt-4">
          <label for="history-input" class="block mb-2 text-sm font-medium text-neutral-900">Sejarah UKM</label>
          <textarea id="history-input" name="history" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan deskripsi singkat tentang UKM ini...">{{ old('about', $data->about ?? '') }}</textarea>
        </div>
        <div class="w-full mt-6">
          <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection