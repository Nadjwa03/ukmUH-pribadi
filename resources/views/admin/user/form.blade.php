@extends('layouts.app')

@if($mode == 'edit')
@section('title', 'Edit User | UKM Admin')
@else
@section('title', 'Buat User | UKM Admin')
@endif

@section('body')
<main class="h-screen w-screen flex">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">{{ $mode == 'edit' ? 'Edit' : 'Buat' }} User</h1>
    <div class="flex flex-col items-center px-6 py-6">
      <form action="{{ $mode == 'edit' ? route('admin.user.edit', $data->id) : route('admin.user.create') }}" enctype="multipart/form-data" method="post" class="flex flex-col items-center max-w-96 w-full">
        @csrf
        @if($mode == 'edit')
        @method('PUT')
        @endif
        <div class="w-full mt-8">
          <label for="name-input" class="block mb-2 text-sm font-medium text-neutral-900">Name</label>
          <input value="{{ old('name', $data->name ?? '') }}" name="name" type="text" id="name-input" placeholder="Input nama lengkap" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          @error('name')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-4">
          <label for="email-input" class="block mb-2 text-sm font-medium text-neutral-900">Email</label>
          <input value="{{ old('email', $data->email ?? '') }}" name="email" type="email" id="email-input" placeholder="Input email" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          @error('email')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div class="w-full mt-4">
          <label for="role-select" class="block mb-2 text-sm font-medium text-neutral-900">Role</label>
          <select id="role-select" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="admin" {{ old('role', $data->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="superadmin" {{ old('role', $data->role ?? '') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
          </select>
          @error('role')
          <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
          @enderror
        </div>
        <div id="club-select-container" class="w-full mt-4">
          <label for="club-select" class="block mb-2 text-sm font-medium text-neutral-900">UKM</label>
          <select id="club-select" name="club" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="none">Pilih UKM</option>
            @foreach($clubs as $club)
            <option value="{{ $club->id }}" {{ old('club', $data->club_id ?? '') == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
            @endforeach
          </select>
          @error('club')
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

<script>
  const roleSelectRef = document.getElementById('role-select');

  function handleClubSelect() {
    const clubSelectRef = document.getElementById('club-select-container');

    clubSelectRef.style.display = roleSelectRef.value === 'admin' ? 'block' : 'none';
  }

  roleSelectRef.addEventListener('change', function() {
    handleClubSelect();
  })

  document.addEventListener('DOMContentLoaded', function() {
    handleClubSelect();
  })
</script>
@endsection