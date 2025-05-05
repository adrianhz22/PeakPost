@props(['action'])

<div class="max-w-4xl mx-auto space-y-6">
    <form action="{{ $action }}" method="GET" class="space-y-6">
        <div class="bg-white dark:bg-gray-100 p-6 rounded-lg shadow-md">
            <div class="flex gap-4 items-center">
                <div class="relative flex-grow">
                    <input
                        type="text"
                        name="search"
                        class="w-full border h-12 pl-4 pr-10 rounded-lg shadow-sm dark:text-gray-800 dark:border-gray-300 dark:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="{{ __('Buscar por nombre o email') }}"
                        value="{{ request('search') }}"
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
                                 s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
