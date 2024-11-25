@extends('layouts.app')

@section('title', 'UKM ' . $club->name . ' | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.club-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full"></div>
</main>
@endsection