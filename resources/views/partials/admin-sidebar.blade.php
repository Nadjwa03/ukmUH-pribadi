<div class="min-h-screen py-4">
  <h1 class="px-9 text-2xl font-semibold">SisUKM</h1>
  <nav class="w-full flex flex-col gap-y-2 p-6">
    <a href="{{ route('admin.user.index') }}" class="flex gap-x-2 p-3 group hover:bg-blue-50 rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current {{ request()->routeIs('admin.user.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600 w-6 h-6" viewBox="0 -960 960 960">
        <path d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z" />
      </svg>
      <span class="{{ request()->routeIs('admin.user.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600">User</span>
    </a>
    <a href="{{ route('admin.club.index') }}" class="flex gap-x-2 p-3 group hover:bg-blue-50 rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="fill-current {{ request()->routeIs('admin.club.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600 w-6 h-6" viewBox="0 -960 960 960">
        <path d="m160-419 101-101-101-101L59-520l101 101Zm540-21 100-160 100 160H700Zm-220-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-160q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640Zm0 40ZM0-240v-63q0-44 44.5-70.5T160-400q13 0 25 .5t23 2.5q-14 20-21 43t-7 49v65H0Zm240 0v-65q0-65 66.5-105T480-450q108 0 174 40t66 105v65H240Zm560-160q72 0 116 26.5t44 70.5v63H780v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5Zm-320 30q-57 0-102 15t-53 35h311q-9-20-53.5-35T480-370Zm0 50Z" />
      </svg>
      <span class="{{ request()->routeIs('admin.club.*') ? 'text-blue-600' : 'text-neutral-700' }} group-hover:text-blue-600">UKM</span>
    </a>
  </nav>
</div>