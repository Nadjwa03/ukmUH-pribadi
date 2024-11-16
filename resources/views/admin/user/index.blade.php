@extends('layouts.app')

@section('title', 'User Home | UKM Admin') <!-- Set dynamic title -->

@section('body')
<main class="min-h-screen flex w-full">
  <aside class="h-full w-80">
    @include('partials.admin-sidebar')
  </aside>
  <div class="min-h-screen bg-neutral-100 w-full">
    <h1 class="font-medium h-16 flex items-center text-xl px-6 py-4 bg-white">Manajemen User</h1>
    <div class="flex flex-col px-6 py-6 space-y-4">
      <div class="w-full flex items-center">
        <a href="{{ route('admin.user.create') }}" class="ml-auto text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah User</a>
      </div>
      <div class="relative overflow-x-auto">
        <table class="w-full text-left rtl:text-right text-gray-500">
          <thead class="text-sm text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">
                Nama Lengkap
              </th>
              <th scope="col" class="px-6 py-3">
                Email
              </th>
              <th scope="col" class="px-6 py-3">
                Role
              </th>
              <th scope="col" class="px-6 py-3">
                UKM Terhubung
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

            @foreach($users as $user)
            <tr class="bg-white h-16">
              <td class="px-6 py-4">
                {{ $user->name }}
              </td>
              <td class="px-6 py-4">
                {{ $user->email }}
              </td>
              <td class="px-6 py-4">
                @if($user->role == 'admin') Admin @elseif($user->role == 'superadmin') Super Admin @else ~ @endif
              </td>
              <td class="px-6 py-4">
                @if($user->role == 'admin') {{ $user->club->name }} @else ~ @endif
              </td>
              <td class="px-6 py-4">
                @if($user->trashed())
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Inaktif</span>
                @else
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Aktif</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="text-blue-700 hover:text-blue-800 active:text-blue-800">Edit</a>
                <button data-modal-target="reset-password-user-{{ $user->id }}" data-modal-toggle="reset-password-user-{{ $user->id }}" class="ml-4 text-blue-700 hover:text-blue-800 active:text-blue-800" type="button">
                  Reset Password
                </button>
                @if($user->trashed())
                <button data-modal-target="activate-user-{{ $user->id }}" data-modal-toggle="activate-user-{{ $user->id }}" class="ml-4 text-neutral-500 hover:text-blue-700 active:text-blue-700" type="button">
                  Aktivasi
                </button>
                @else
                <button data-modal-target="deactivate-user-{{ $user->id }}" data-modal-toggle="deactivate-user-{{ $user->id }}" class="ml-4 text-neutral-500 hover:text-blue-700 active:text-blue-700" type="button">
                  Deaktivasi
                </button>
                @endif
              </td>
            </tr>
            <x-dialog.activate-confirmation
              modalId="activate-user-{{ $user->id }}"
              title="Aktivasi User"
              message="Apakah kamu yakin untuk aktivasi akun user ini ({{ $user->name }})?"
              action="{{ route('admin.user.activate', ['id' => $user->id]) }}"
              confirmText="Ya, Aktivasi"
              cancelText="Batal" />
            <x-dialog.deactivate-confirmation
              modalId="deactivate-user-{{ $user->id }}"
              title="Deaktivasi User"
              message="Apakah kamu yakin untuk deaktivasi akun user ini ({{ $user->name }})?"
              action="{{ route('admin.user.deactivate', ['id' => $user->id]) }}"
              confirmText="Ya, Deaktivasi"
              cancelText="Batal" />
            <x-dialog.reset-password
              modalId="reset-password-user-{{ $user->id }}"
              title="Reset Password"
              message="Apakah kamu yakin untuk reset password akun user ini ({{ $user->name }})?"
              action="{{ route('admin.user.reset_password', ['id' => $user->id]) }}"
              confirmText="Ya, Reset"
              cancelText="Batal" />
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>
@endsection