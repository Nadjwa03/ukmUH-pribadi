@extends('layouts.app')

@section('title', 'Dashboard | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">Profile</h1>
    <div class="min-h-screen flex flex-col px-6 pb-6 pt-2">

    </div>
  </div>
</main>
@endsection