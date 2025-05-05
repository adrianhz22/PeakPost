@props(['action', 'provinces' => [], 'difficulties' => []])

<div x-data="{ open: false }" class="max-w-4xl mx-auto space-y-6">
    <form action="{{ $action }}" method="GET" class="space-y-6">
        <div class="bg-white dark:bg-gray-100 p-6 rounded-lg shadow-md">
            <div class="flex gap-4 items-center">
                <div class="relative flex-grow">
                    <input
                        type="text"
                        name="query"
                        class="w-full border h-12 pl-4 pr-10 rounded-lg shadow-sm dark:text-gray-800 dark:border-gray-300 dark:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="{{ __('Search') }}"
                        value="{{ request('query') }}"
                    >
                    <button type="submit" class="absolute top-1/2 right-3 -translate-y-1/2">
                        <svg class="text-teal-600 h-5 w-5 fill-current dark:text-teal-700"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786
                                 c0-12.682-10.318-23-23-23s-23,10.318-23,23
                                 s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162
                                 l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                                 c0.779,0,1.518-0.297,2.079-0.837
                                 C56.255,54.982,56.293,53.08,55.146,51.887z
                                 M23.984,6c9.374,0,17,7.626,17,17
                                 s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                        </svg>
                    </button>
                </div>

                <div>
                    <button
                        type="button"
                        @click="open = !open"
                        class="text-sm px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md shadow transition"
                    >
                        <span x-show="!open">{{ __('Mostrar filtros') }}</span>
                        <span x-show="open">{{ __('Ocultar filtros') }}</span>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition class="bg-white dark:bg-gray-100 p-6 rounded-lg shadow-md space-y-4">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">{{ __('Filtros') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label for="province"
                           class="block text-sm font-medium text-gray-600 mb-1">{{ __('Provincia') }}</label>
                    <select name="province" id="province"
                            class="w-full h-12 border rounded-lg px-4 pr-10 shadow-sm dark:bg-gray-200 dark:border-gray-300 dark:text-gray-800">
                        <option value="">{{ __('Todas las provincias') }}</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov }}" @selected(request('province') === $prov)>{{ $prov }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="difficulty"
                           class="block text-sm font-medium text-gray-600 mb-1">{{ __('Dificultad') }}</label>
                    <select name="difficulty" id="difficulty"
                            class="w-full h-12 border rounded-lg px-4 pr-10 shadow-sm dark:bg-gray-200 dark:border-gray-300 dark:text-gray-800">
                        <option value="">{{ __('Todas las dificultades') }}</option>
                        @foreach($difficulties as $difficulty)
                            <option
                                value="{{ $difficulty }}" @selected(request('difficulty') === $difficulty)>{{ $difficulty }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sort"
                           class="block text-sm font-medium text-gray-600 mb-1">{{ __('Ordenar por') }}</label>
                    <select name="sort" id="sort"
                            class="w-full h-12 border rounded-lg px-4 pr-10 shadow-sm dark:bg-gray-200 dark:border-gray-300 dark:text-gray-800">
                        <option value="desc" @selected(request('sort') === 'desc')>{{ __('Más recientes') }}</option>
                        <option
                            value="popular" @selected(request('sort') === 'popular')>{{ __('Más populares') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
