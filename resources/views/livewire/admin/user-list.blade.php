<div class="max-w-7xl mx-auto">

    <div class="flex justify-center items-center w-full mb-6">
        <div class="relative w-full md:w-1/2">
            <x-user-filter :action="route('admin.users')"/>
        </div>
    </div>

    <div x-data="{ open: false }" class="mb-6">
        <button @click="open = !open"
                class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
            <span x-show="!open">{{ __('Create new user') }}</span>
            <span x-show="open">{{ __('Close form') }}</span>
        </button>

        @if($editingUserId)
            <div class="mt-6 bg-white shadow-md rounded-md p-6 max-w-2xl">
                <h2 class="text-lg font-semibold mb-4 text-gray-800">{{ __('Edit user') }}</h2>

                <form wire:submit.prevent="updateUser" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input wire:model.defer="name" type="text"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
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
                        <input wire:model.defer="email" type="email"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('New password (optional)') }}</label>
                        <input wire:model.defer="password" type="password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            {{ __('Save changes') }}
                        </button>
                        <button wire:click="$set('editingUserId', null)"
                                class="bg-gray-400 text-white px-4 py-2 rounded">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div x-show="open" x-transition class="mt-4 bg-white shadow-md rounded-md p-6 max-w-2xl">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">{{ __('Create new user') }}/h2>

            <form wire:submit.prevent="createUser" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                    <input wire:model.defer="name" type="text"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
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
                    <input wire:model.defer="email" type="email"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                    <input wire:model.defer="password" type="password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <button type="submit"
                        class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    {{ __('Create user') }}
                </button>
            </form>
        </div>
    </div>

    <div class="inline-block min-w-full py-2 align-middle">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID
                    </th>
                    <th scope="col"
                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">{{ __('Name') }}</th>
                    <th scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('Email') }}</th>
                    <th scope="col"
                        class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">{{ __('Registration') }}</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">{{__('Actions')}}</span>
                    </th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($users as $user)
                    <tr>
                        <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $user->id }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $user->name }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-3 py-4 text-sm text-center text-gray-500">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>

                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6" x-data="{ menu: false }">
                            <div class="inline-block text-left">
                                <button x-on:click="menu = !menu" type="button"
                                        class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <span class="sr-only">{{ __('Open options') }}</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>

                                <div x-show="menu" x-on:click.away="menu = false"
                                     class="absolute right-32 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                    <div>
                                        <a href="{{ route('users.show', $user->username) }}"
                                           class="text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm">
                                            {{ __('Details') }}
                                        </a>
                                    </div>
                                    <div>
                                        <button wire:click="deleteUser({{ $user->id }})"
                                                class="cursor-pointer text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm">
                                            {{ __('Delete') }}
                                        </button>
                                    </div>
                                    <div>
                                        <button wire:click="editUser({{ $user->id }})"
                                                class="cursor-pointer text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm">
                                            {{ __('Edit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
