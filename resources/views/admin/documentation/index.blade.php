@extends('layouts.app')

@section('title', 'Dokumentasi Home | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">Manajemen Dokumentasi</h1>
    <div class="flex flex-col px-6 py-6 space-y-4">
      <div class="w-full flex items-center">
        <a href="{{ route('admin.documentation.create') }}" class="ml-auto text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Dokumentasi</a>
      </div>
      <div class="relative overflow-x-auto flex gap-x-6 gap-y-4">
        @foreach($documentations as $documentation)
        <div class="min-h-[23rem] max-w-[22rem] flex flex-col p-4 bg-white w-fit shadow-md border border-neutral-300 rounded-lg">
          @if($documentation->image)
          <img class="h-[11.25rem] w-full flex-shrink-0" src="{{ asset('storage/' . $documentation->image) }}" alt="{{ $documentation->title }}" />
          @else
          <div class="h-[11.25rem] w-full flex-shrink-0 flex items-center justify-center">No Logo</div>
          @endif
          <img />
          <div class="mt-3 w-full">
            <p class="text-neutral-900 flex items-center">{{ $documentation->title }} @if($documentation->trashed()) <span class="ml-1 text-red-600 bg-red-100 px-1.5 py-0.5 rounded-md text-xs">Non-Aktif</span> @else <span class="ml-1 rounded-md px-1.5 py-0.5 text-xs text-green-600 bg-green-100">Aktif</span> @endif</p>
            @php
            \Carbon\Carbon::setLocale('id'); // Set locale to Indonesian
            @endphp
            <p class="text-neutral-900 flex items-center text-xs">{{ \Carbon\Carbon::parse($documentation->date)->translatedFormat('d F Y') }}</p>
            <p class="text-xs text-neutral-500 w-full mt-1">Terakhir diubah: {{ $documentation->updated_at->toDayDateTimeString() }} (<span class="italic">{{$documentation->updated_at->diffForHumans()}}</span>)</p>
          </div>
          <div class="mt-auto w-full flex gap-x-2.5 text-sm">
            <a href="{{ route('admin.documentation.view_edit', $documentation->id) }}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
              Edit
            </a>
            @if($documentation->trashed())
            <button data-modal-target="activate-documentation-{{ $documentation->id }}" data-modal-toggle="activate-documentation-{{ $documentation->id }}" class="py-2.5 px-5 text-sm font-medium text-neutral-900 focus:outline-none bg-white rounded-lg border border-neutral-200 hover:bg-neutral-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-neutral-100" type="button">
              Aktivasi
            </button>
            @else
            <button data-modal-target="deactivate-documentation-{{ $documentation->id }}" data-modal-toggle="deactivate-documentation-{{ $documentation->id }}" class="py-2.5 px-5 text-sm font-medium text-neutral-900 focus:outline-none bg-white rounded-lg border border-neutral-200 hover:bg-neutral-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-neutral-100" type="button">
              Deaktivasi
            </button>
            @endif

          </div>
        </div>
        <x-dialog.activate-confirmation
          modalId="activate-documentation-{{ $documentation->id }}"
          title="Aktivasi UKM"
          message="Apakah kamu yakin untuk aktivasi UKM ini ({{ $documentation->title }})?"
          action="{{ route('admin.documentation.activate', ['id' => $documentation->id]) }}"
          confirmText="Ya, Aktivasi"
          cancelText="Batal" />
        <x-dialog.deactivate-confirmation
          modalId="deactivate-documentation-{{ $documentation->id }}"
          title="Deaktivasi UKM"
          message="Apakah kamu yakin untuk deaktivasi UKM ini ({{ $documentation->title }})?"
          action="{{ route('admin.documentation.deactivate', ['id' => $documentation->id]) }}"
          confirmText="Ya, Deaktivasi"
          cancelText="Batal" />
        @endforeach
      </div>
    </div>
  </div>

</main>
@endsection