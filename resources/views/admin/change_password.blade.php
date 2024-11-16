@extends('layouts.app')

@section('title', 'Change Password | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="h-screen w-screen flex items-center justify-center">

  <form action="{{ route('admin.change_password') }}" method="post" class="flex flex-col items-center max-w-96 w-full">
    @csrf
    @method('PATCH')
    <h2 class="text-xl text-neutral-900 font-semibold">
      Admin Change Password
    </h2>
    <div class="w-full mt-8">
      <label for="old_password-input" class="block mb-2 text-sm font-medium text-neutral-900">Old Password</label>
      <input name="old_password" type="password" id="old_password-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      @error('old_password')
      <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
      @enderror
    </div>
    <div class="w-full mt-4">
      <label for="new_password-input" class="block mb-2 text-sm font-medium text-neutral-900">New Password</label>
      <input name="new_password" type="password" id="new_password-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      @error('new_password')
      <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
      @enderror
    </div>
    <div class="w-full mt-6">
      <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
    </div>
  </form>
</main>
@endsection