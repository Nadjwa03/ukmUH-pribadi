@extends('layouts.app')

@section('title', 'UKM Home | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">Manajemen UKM</h1>
    <div class="flex flex-col px-6 py-6 space-y-4">
      <div class="w-full flex items-center">
        <a href="{{ route('admin.club.create') }}" class="ml-auto text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah UKM</a>
      </div>
      <div class="relative overflow-x-auto">
        <table class="w-full text-left rtl:text-right text-neutral-500">
          <thead class="text-sm text-neutral-700 uppercase bg-neutral-50">
            <tr>
              <th scope="col" class="px-6 py-3 w-40">
                Logo
              </th>
              <th scope="col" class="px-6 py-3">
                Nama
              </th>
              <th scope="col" class="px-6 py-3">
                Status
              </th>
              <th scope="col" class="px-6 py-3">
                Action
              </th>
            </tr>
          </thead>
          <tbody>

            @foreach($clubs as $club)
            <tr class="bg-white h-16">
              <td class="px-6 py-2 w-40">
                @if($club->logo)
                <img class="h-12" src="{{ asset('storage/' . $club->logo) }}" alt="No Logo" />
                @else
                No Logo
                @endif
              </td>
              <td class="px-6 py-4">
                @if($club->trashed())
                <p class="text-neutral-700">
                  {{ $club->name }}
                </p>
                @else
                <a class="text-blue-700 hover:text-blue-800" target="_blank" href="{{ route('admin.club.details', ['clubId' => $club->id]) }}">
                  {{ $club->name }}
                </a>
                @endif
              </td>
              <td class="px-6 py-4">
                @if($club->trashed())
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Inaktif</span>
                @else
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Aktif</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.club.edit', ['id' => $club->id]) }}" class="text-blue-700 hover:text-blue-800 active:text-blue-800">Edit</a>
                @if($club->trashed())
                <button data-modal-target="activate-club-{{ $club->id }}" data-modal-toggle="activate-club-{{ $club->id }}" class="ml-4 text-neutral-500 hover:text-blue-700 active:text-blue-700" type="button">
                  Aktivasi
                </button>
                @else
                <button data-modal-target="deactivate-club-{{ $club->id }}" data-modal-toggle="deactivate-club-{{ $club->id }}" class="ml-4 text-neutral-500 hover:text-blue-700 active:text-blue-700" type="button">
                  Deaktivasi
                </button>
                @endif
              </td>
            </tr>
            <x-dialog.activate-confirmation
              modalId="activate-club-{{ $club->id }}"
              title="Aktivasi UKM"
              message="Apakah kamu yakin untuk aktivasi UKM ini ({{ $club->name }})?"
              action="{{ route('admin.club.activate', ['id' => $club->id]) }}"
              confirmText="Ya, Aktivasi"
              cancelText="Batal" />
            <x-dialog.deactivate-confirmation
              modalId="deactivate-club-{{ $club->id }}"
              title="Deaktivasi UKM"
              message="Apakah kamu yakin untuk deaktivasi UKM ini ({{ $club->name }})?"
              action="{{ route('admin.club.deactivate', ['id' => $club->id]) }}"
              confirmText="Ya, Deaktivasi"
              cancelText="Batal" />
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>
@endsection