<div id="{{ $modalId }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    {{ $title ?? 'Confirmation' }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="{{ $modalId }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500">
                    {{ $message ?? 'Are you sure you want to perform this action?' }}
                </p>
            </div>
            <!-- Modal Footer -->
            <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-red-600 hover:bg-red-100 border border-red-600  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        {{ $confirmText ?? 'Yes' }}
                    </button>
                </form>
                <button data-modal-hide="{{ $modalId }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                    {{ $cancelText ?? 'No' }}
                </button>
            </div>
        </div>
    </div>
</div>