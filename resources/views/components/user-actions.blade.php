@props(['user'])

<div x-data="{ menu: false }" class="inline-block text-left">
    <button @click="menu = !menu" type="button"
            class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
        <span class="sr-only">{{ __('Open options') }}</span>
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
        </svg>
    </button>

    <div x-show="menu" @click.away="menu = false"
         class="absolute right-32 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50 divide-y divide-gray-100">
        <a href="{{ route('users.show', $user->username) }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            {{ __('Details') }}
        </a>
        <button wire:click="editUser({{ $user->id }})"
                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            {{ __('Edit') }}
        </button>
        <button wire:click="deleteUser({{ $user->id }})"
                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
            {{ __('Delete') }}
        </button>
        <div class="border-t border-gray-100">
            @if(!$user->hasRole('moderator'))
                <form method="POST" action="{{ route('admin.users.assignRole', $user) }}">
                    @csrf
                    <input type="hidden" name="role" value="moderator">
                    <button type="submit"
                            class="w-full text-left text-indigo-600 hover:bg-gray-50 block px-4 py-2 text-sm">
                        {{ __('Assign Moderator') }}
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.users.removeRole', $user) }}">
                    @csrf
                    <input type="hidden" name="role" value="moderator">
                    <button type="submit"
                            class="w-full text-left text-red-600 hover:bg-gray-50 block px-4 py-2 text-sm">
                        {{ __('Remove Moderator') }}
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
