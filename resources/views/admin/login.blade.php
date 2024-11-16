@extends('layouts.app')

@section('title', 'Login | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="h-screen w-screen flex items-center justify-center">

  <form action="{{ route('admin.login') }}" method="post" class="flex flex-col items-center max-w-96 w-full">
    @csrf
    <h2 class="text-xl text-neutral-900 font-semibold">
      Admin Login
    </h2>
    <div class="w-full mt-8">
      <label for="email-input" class="block mb-2 text-sm font-medium text-neutral-900">Email</label>
      <input name="email" type="email" id="email-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      @error('email')
      <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
      @enderror
    </div>
    <div class="w-full mt-4">
      <label for="password-input" class="block mb-2 text-sm font-medium text-neutral-900">Password</label>
      <input name="password" type="password" id="password-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      @error('password')
      <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
      @enderror
    </div>
    <div class="w-full mt-6">
      <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
    </div>
  </form>
</main>
@endsection