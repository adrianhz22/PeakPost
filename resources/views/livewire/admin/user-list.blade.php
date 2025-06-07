<div class="max-w-7xl mx-auto">

    <div class="flex justify-center items-center w-full mb-6">
        <div class="relative w-full md:w-1/2">
            <x-filters.user-filter/>
        </div>
    </div>

    <div x-data="{ open: false }" class="mb-6">
        <button
            @click="open = !open" wire:click="resetForm"
            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
            <span x-show="!open">{{ __('Create new user') }}</span>
            <span x-show="open">{{ __('Close form') }}</span>
        </button>

        @if($editingUserId)
            <x-user-form :editing="true"/>
        @endif

        <div x-show="open" x-transition>
            <x-user-form/>
        </div>
    </div>

    <x-user-table :users="$users"/>
</div>
