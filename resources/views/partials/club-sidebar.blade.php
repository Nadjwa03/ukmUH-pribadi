<div class="min-h-screen w-80 flex items-center flex-col py-4">
  <div class="px-9 w-full flex flex-col space-y-4">
    <a href="{{ route('admin.club.details', ['clubId' => request()->route('clubId')]) }}">
      <h1 class="w-full text-2xl font-semibold">SisUKM <span class="text-base font-normal">({{ $club->name }})</span></h1>
    </a>
    @if(Auth::user()->role == 'superadmin')
    <a href="{{ route('admin.index') }}" class="block w-full text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
      Back to SisUKM (Admin)
    </a>
    @endif
  </div>
  <nav class="w-full flex flex-col gap-y-2 p-6">
    <a href="{{ route('admin.club.accomplishment.index', ['clubId' => request()->route('clubId')]) }}" class="w-full flex gap-x-2 p-3 group hover:bg-blue-50 rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current {{ request()->routeIs('admin.club.accomplishment.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600 w-6 h-6" viewBox="0 -960 960 960">
        <path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z" />
      </svg>
      <span class="{{ request()->routeIs('admin.club.accomplishment.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600">Prestasi</span>
    </a>
    <a href="{{ route('admin.club.documentation.index', ['clubId' => request()->route('clubId')]) }}" class="w-full flex gap-x-2 p-3 group hover:bg-blue-50 rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current {{ request()->routeIs('admin.club.documentation.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600 w-6 h-6" viewBox="0 -960 960 960">
        <path d="M360-400h400L622-580l-92 120-62-80-108 140Zm-40 160q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320Zm0-80h480v-480H320v480ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z" />
      </svg>
      <span class="{{ request()->routeIs('admin.club.documentation.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600">Dokumentasi</span>
    </a>
    <a href="{{ route('admin.club.event.index', ['clubId' => request()->route('clubId')]) }}" class="w-full flex gap-x-2 p-3 group hover:bg-blue-50 rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current {{ request()->routeIs('admin.club.event.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600 w-6 h-6" viewBox="0 -960 960 960">
        <path d="M580-240q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Z" />
      </svg>
      <span class="{{ request()->routeIs('admin.club.event.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600">Event</span>
    </a>
  </nav>
  <div class="mt-auto px-9 w-full flex flex-col space-y-4">
    <p>Hello, {{ Auth::user()->name }}</p>
    <a href="{{ route('admin.logout') }}" class="block w-full text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Logout</a>
  </div>
</div>