<x-app-layout>
    <x-slot name="title">{{ __('Edit post') }}</x-slot>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">{{ __('Edit post') }}</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <x-input-label :value="__('Current image')"/>
                <img src="{{ asset($post->image) }}" class="w-full h-64 object-cover rounded-lg mt-2">
            </div>

            <x-dropzone name="image" label="{{ __('New image') }}"/>
            <input type="hidden" name="image" id="imageInput" value="{{ old('image', $post->image) }}">
            <x-input-error :messages="$errors->get('image')" class="mt-2"/>

            <div class="mb-4">
                <x-input-label for="title" :value="__('Title')"/>
                <x-input id="title" name="title" type="text" :value="old('title', $post->title)" required/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <div class="mb-4">
                <x-input-label for="body" :value="__('Content')"/>
                <x-trix-editor id="body" name="body" :value="old('body', $post->body)"/>
                <x-input-error :messages="$errors->get('body')" class="mt-2"/>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="province" :value="__('Province')"/>
                    <x-select name="province" :options="$provinces" :selected="old('province', $post->province)"/>
                    <x-input-error :messages="$errors->get('province')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="difficulty" :value="__('Difficulty')"/>
                    <x-select name="difficulty" :options="$difficulties"
                              :selected="old('difficulty', $post->difficulty)"/>
                    <x-input-error :messages="$errors->get('difficulty')" class="mt-2"/>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="longitude" :value="__('Longitude')"/>
                    <x-input id="longitude" name="longitude" type="number" :value="old('longitude', $post->longitude)"/>
                </div>

                <div>
                    <x-input-label for="altitude" :value="__('Altitude')"/>
                    <x-input id="altitude" name="altitude" type="number" :value="old('altitude', $post->altitude)"/>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="time" :value="__('Duration')"/>
                    <input type="time" name="time" id="time" step="1" value="{{ old('time', $post->time) }}"
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

            <x-button>{{ __('Save changes') }}</x-button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">{{ __('Back to home') }}</a>
        </div>
    </div>
</x-app-layout>
