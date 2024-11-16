<div class="min-h-screen w-80 flex items-center flex-col py-4">
  <div class="px-9 w-full flex flex-col space-y-4">
    <a href="{{ route('admin.club.details', ['clubId' => request()->route('clubId')]) }}">
      <h1 class="w-full text-2xl font-semibold">SisUKM (UKM)</h1>
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
  </nav>
  <div class="mt-auto px-9 w-full flex flex-col space-y-4">
    <p>Hello, {{ Auth::user()->name }}</p>
    <a href="{{ route('admin.logout') }}" class="block w-full text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Logout</a>
  </div>
</div>