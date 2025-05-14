<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav class="bg-gray-800 p-4 text-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-lg font-semibold">PeakPost</a>

        <ul class="flex space-x-4 items-center">

            <li>
                <a href="{{ route('users.index') }}" class="text-base font-medium hover:text-blue-400">Comunidad</a>
            </li>

            @auth
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2">
                        <img
                            src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('assets/default-photo.jpg') }}"
                            alt="Profile photo"
                            class="w-8 h-8 rounded-full object-cover"
                        >
                        <span>{{ Auth::user()->username }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg py-2">
                        <a href="{{ route('profile.show') }}"
                           class="block px-4 py-2 hover:bg-gray-200">{{ __('Profile') }}</a>
                        @if(auth()->user()->hasAnyRole('admin', 'moderator'))
                            <a href="{{ route('admin.dashboard') }}"
                               class="block px-4 py-2 hover:bg-gray-200">{{ __('Administration') }}</a>
                        @endif
                        <a href="{{ route('posts.user-posts') }}"
                           class="block px-4 py-2 hover:bg-gray-200">{{ __('My posts') }}</a>
                        <a href="{{ route('posts.liked') }}"
                           class="block px-4 py-2 hover:bg-gray-200">{{ __('My likes') }}</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-200">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</nav>
