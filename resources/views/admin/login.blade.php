@extends('layouts.app')

@section('title', 'Login | UKM Admin') <!-- Set dynamic title -->

@section('body')
    <main class="h-screen w-screen bg-red-900 flex items-center justify-center">
      <div class="bg-white rounded-lg shadow-lg flex flex-col lg:flex-row w-[1000px]">

        {{-- kiri --}}
        <div class="w-full lg:w-1/2 bg-cover bg-center rounded-l-lg" ">
          <img src="{{ asset('asset/login-img.JPG') }}" alt="Image-rektorat-login" class=" max-w-lg rounded-l-lg">
        </div>
                    
        {{-- kanan --}}
          <div class="w-full lg:w-1/2 p-8 flex flex-col justify-center">
              <div class="text-center mb-6 ml-6">
                <h1 class="text-xl text-red-900 font-bold">
                    Login Admin UKM
                </h1>
              </div>
              
              <form action="{{ route('admin.login') }}" method="post" class="flex flex-col items-center max-w-sm w-full mx-auto">
                @csrf
                <div class=" w-full mt-4">
                  <label for="email-input" class="block mb-2 text-sm font-medium text-red-900">Email</label>
                  <input name="email" type="email" id="email-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-red-900 focus:border-red-900 block w-full p-2.5">
                  @error('email')
        <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
        @enderror
                </div>
                <div class="w-full mt-4">
                  <label for="password-input" class="block mb-2 text-sm font-medium text-red-900">Password</label>
                  <input name="password" type="password" id="password-input" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-red-900 focus:border-red-900 block w-full p-2.5">
                  @error('password')
        <div class="text-xs text-red-600 mt-0.5">{{ $message }}</div>
        @enderror
                </div>
                <div class="w-full mt-6">
                  <button type="submit" class="w-full text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
                </div>
              </form>







          </div>
      </div>

    </main>
@endsection
