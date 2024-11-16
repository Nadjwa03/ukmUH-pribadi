@extends('layouts.app')

@if($mode == 'edit')
@section('title', 'Edit Dokumentasi | UKM Admin')
@else
@section('title', 'Buat Dokumentasi | UKM Admin')
@endif

@section('body')
<main class="h-screen w-screen flex">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">{{ $mode == 'edit' ? 'Edit' : 'Buat' }} Dokumentasi</h1>
    <div class="flex flex-col items-center px-6 py-6">
      <form action="{{ $mode == 'edit' ? route('admin.documentation.edit', $data->id) : route('admin.documentation.create') }}" enctype="multipart/form-data" method="post" class="flex flex-col items-center max-w-96 w-full">
        @csrf
        @if($mode == 'edit')
        @method('PUT')
        @endif
        <div class="w-full mt-8">
          <label for="title-input" class="block mb-2 text-sm font-medium text-neutral-900">Judul</label>
          <input value="{{ old('title', $data->title ?? '') }}" name="title" type="text" id="title-input" placeholder="Input title poster" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          @error('title')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-8">
          <label for="date-input" class="block mb-2 text-sm font-medium text-neutral-900">Tanggal Dokumentasi</label>
          <input value="{{ old('date', $data->date ?? now()->toDateString()) }}" name="date" type="date" id="date-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          @error('date')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-4">
          <label for="image-input" class="block mb-2 text-sm font-medium text-neutral-900">Gambar</label>
          <input aria-describedby="file_input_help" name="image" type="file" id="image-input" class="block w-full text-sm text-neutral-900 border border-neutral-300 rounded-lg cursor-pointer bg-neutral-50 focus:outline-none">
          @error('image')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-6">
          <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection