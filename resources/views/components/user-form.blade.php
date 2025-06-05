@props(['editing' => false])

<div class="mt-6 bg-white shadow-md rounded-md p-6 max-w-2xl">
    <h2 class="text-lg font-semibold mb-4 text-gray-800">
        {{ $editing ? __('Edit user') : __('Create new user') }}
    </h2>

    <form wire:submit.prevent="{{ $editing ? 'updateUser' : 'createUser' }}" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <input wire:model.defer="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Last name') }}</label>
            <input wire:model.defer="last_name" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('last_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Username') }}</label>
            <input wire:model.defer="username" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('username') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <input wire:model.defer="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                {{ $editing ? __('New password (optional)') : __('Password') }}
            </label>
            <input wire:model.defer="password" type="password"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ $editing ? __('Save Changes') : __('Create user') }}
            </button>

            @if($editing)
                <button wire:click="resetForm" type="button" class="bg-gray-400 text-white px-4 py-2 rounded">
                    {{ __('Cancel') }}
                </button>
            @endif
        </div>
    </form>
</div>
