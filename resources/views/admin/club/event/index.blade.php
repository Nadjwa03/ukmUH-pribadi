@extends('layouts.app')

@section('title', 'Event UKM (' . $club->name . ') | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.club-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">Manajemen Event</h1>
    <div class="flex flex-col px-6 py-6 space-y-4">
      <div class="w-full flex items-center">
        <a href="{{ route('admin.club.event.create', ['clubId' => $club->id]) }}" class="ml-auto text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Event</a>
      </div>
      <div class="relative overflow-x-auto flex gap-x-6 gap-y-4">
        @foreach($events as $event)
        <div class="min-h-[35rem] max-w-[22rem] flex flex-col p-4 bg-white w-fit shadow-md border border-neutral-300 rounded-lg">
          @if($event->image)
          <img class="h-[24rem] w-full flex-shrink-0" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" />
          @else
          <div class="h-[24rem] w-full flex-shrink-0 flex items-center justify-center">No Logo</div>
          @endif
          <img />
          <div class="mt-3 w-full space-y-1">
            <p class="text-neutral-900 flex items-center">{{ $event->title }}</p>
            @if($event->trashed()) <p class="w-fit text-red-600 bg-red-100 px-1.5 py-0.5 rounded-md text-xs">Non-Aktif</p> @else <p class="w-fit rounded-md px-1.5 py-0.5 text-xs text-green-600 bg-green-100">Aktif</p> @endif
            @php
            \Carbon\Carbon::setLocale('id'); // Set locale to Indonesian
            @endphp
            <p class="text-xs text-neutral-500 w-full">Terakhir diubah: {{ $event->updated_at->toDayDateTimeString() }} (<span class="italic">{{$event->updated_at->diffForHumans()}}</span>)</p>
          </div>
          <div class="mt-auto w-full flex gap-x-2.5 text-sm">
            <a href="{{ route('admin.club.event.view_edit', ['clubId' => $club->id, 'id' => $event->id]) }}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
              Edit
            </a>
            @if($event->trashed())
            <button data-modal-target="activate-event-{{ $event->id }}" data-modal-toggle="activate-event-{{ $event->id }}" class="py-2.5 px-5 text-sm font-medium text-neutral-900 focus:outline-none bg-white rounded-lg border border-neutral-200 hover:bg-neutral-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-neutral-100" type="button">
              Aktivasi
            </button>
            @else
            <button data-modal-target="deactivate-event-{{ $event->id }}" data-modal-toggle="deactivate-event-{{ $event->id }}" class="py-2.5 px-5 text-sm font-medium text-neutral-900 focus:outline-none bg-white rounded-lg border border-neutral-200 hover:bg-neutral-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-neutral-100" type="button">
              Deaktivasi
            </button>
            @endif

          </div>
        </div>
        <x-dialog.activate-confirmation
          modalId="activate-event-{{ $event->id }}"
          title="Aktivasi Event"
          message="Apakah kamu yakin untuk aktivasi post event ini?"
          action="{{ route('admin.club.event.activate', ['clubId' => $club->id, 'id' => $event->id]) }}"
          confirmText="Ya, Aktivasi"
          cancelText="Batal" />
        <x-dialog.deactivate-confirmation
          modalId="deactivate-event-{{ $event->id }}"
          title="Deaktivasi Event"
          message="Apakah kamu yakin untuk deaktivasi post event ini?"
          action="{{ route('admin.club.event.deactivate', ['clubId' => $club->id, 'id' => $event->id]) }}"
          confirmText="Ya, Deaktivasi"
          cancelText="Batal" />
        @endforeach
      </div>
    </div>
  </div>
</main>
@endsection