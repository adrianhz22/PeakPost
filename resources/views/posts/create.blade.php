<x-app-layout>
    <x-slot name="title">{{ __('Create post') }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">{{ __('Create post') }}</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <x-dropzone name="image" label="{{ __('Cover image') }}"/>
            <x-input-error :messages="$errors->get('image')" class="mt-2"/>

            <div class="mb-4">
                <x-input-label for="title" :value="__('Title')"/>
                <x-input name="title" type="text" required/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <x-trix-editor name="body" label="{{ __('Content') }}"/>
                <x-input-error :messages="$errors->get('body')" class="mt-2"/>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-select name="province" label="{{ __('Province') }}" :options="$provinces"
                              placeholder="{{ __('Select a province') }}"/>
                    <x-input-error :messages="$errors->get('province')" class="mt-2"/>
                </div>

                <div>
                    <x-select name="difficulty" label="{{ __('Difficulty') }}" :options="$difficulties"
                              placeholder="{{ __('Select a difficulty') }}"/>
                    <x-input-error :messages="$errors->get('difficulty')" class="mt-2"/>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="longitude" :value="__('Longitude')"/>
                    <x-input name="longitude" type="number"/>
                    <x-input-error :messages="$errors->get('longitude')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="altitude" :value="__('Altitude')"/>
                    <x-input name="altitude" type="number"/>
                    <x-input-error :messages="$errors->get('altitude')" class="mt-2"/>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="time" :value="__('Duration')"/>
                    <input type="time" id="time" name="time" step="1"
                           class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300"/>
                    <x-input-error :messages="$errors->get('time')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="track" :value="__('Upload track (.kml)')"/>
                    <input type="file" id="track" name="track" accept=".kml"
                           class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300"/>
                    <x-input-error :messages="$errors->get('track')" class="mt-2"/>
                </div>
            </div>

            <x-button>{{ __('Publish') }}</x-button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">{{ __('Back to home') }}</a>
        </div>
    </div>
</x-app-layout>
