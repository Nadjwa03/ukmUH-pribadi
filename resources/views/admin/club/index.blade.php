@extends('layouts.app')

@section('title', 'UKM Home | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">Manajemen UKM</h1>
    <div class="flex flex-col px-6 py-6">
      <div class="relative overflow-x-auto">
        <table class="w-full text-left rtl:text-right text-gray-500">
          <thead class="text-sm text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 w-40">
                Logo
              </th>
              <th scope="col" class="px-6 py-3">
                Nama
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
                {{ $club->name }}
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