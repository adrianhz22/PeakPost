@if(isset($post))
    <div class="mb-6">
        <x-form.input-label :value="__('Current image')"/>
        <img src="{{ asset($post->image) }}" class="w-full h-64 object-cover rounded-lg mt-2">
    </div>
@endif

<x-form.dropzone
    name="image"
    label="{{ isset($post) ? __('New image') : __('Cover image') }}"
    :value="isset($post) ? asset('storage/' . $post->image) : ''"
/>

<x-form.input-error :messages="$errors->get('image')" class="mt-2"/>

<div class="mb-4">
    <x-form.input-label for="title" :value="__('Title')"/>
    <x-form.input id="title" name="title" type="text" :value="old('title', $post->title ?? '')" required/>
    <x-form.input-error :messages="$errors->get('title')" class="mt-2"/>
</div>

<div class="mb-4">
    <x-form.input-label for="body" :value="__('Content')"/>
    <x-form.trix-editor id="body" name="body" :value="old('body', $post->body ?? '')" required/>
    <x-form.input-error :messages="$errors->get('body')" class="mt-2"/>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <x-form.input-label for="province" :value="__('Province')"/>
        <x-form.select name="province" :options="$provinces" :selected="old('province', $post->province ?? '')" required/>
        <x-form.input-error :messages="$errors->get('province')" class="mt-2"/>
    </div>

    <div>
        <x-form.input-label for="difficulty" :value="__('Difficulty')"/>
        <x-form.select name="difficulty" :options="$difficulties" :selected="old('difficulty', $post->difficulty ?? '')"
                  required/>
        <x-form.input-error :messages="$errors->get('difficulty')" class="mt-2"/>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <x-form.input-label for="longitude" :value="__('Longitude')"/>
        <x-form.input id="longitude" name="longitude" type="number" :value="old('longitude', $post->longitude ?? '')"
                 required/>
        <x-form.input-error :messages="$errors->get('longitude')" class="mt-2"/>
    </div>

    <div>
        <x-form.input-label for="altitude" :value="__('Altitude')"/>
        <x-form.input id="altitude" name="altitude" type="number" :value="old('altitude', $post->altitude ?? '')"/>
        <x-form.input-error :messages="$errors->get('altitude')" class="mt-2"/>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-form.input-label for="duration_hours" :value="__('Duration (hours)')"/>
            <x-form.input id="duration_hours" name="duration_hours" type="number" min="0"
                     :value="old('duration_hours', isset($post) ? floor(($post->duration ?? 0) / 60) : '')" required/>
            <x-form.input-error :messages="$errors->get('duration_hours')" class="mt-2"/>
        </div>

        <div>
            <x-form.input-label for="duration_minutes" :value="__('Duration (minutes)')"/>
            <x-form.input id="duration_minutes" name="duration_minutes" type="number" min="0" max="59"
                     :value="old('duration_minutes', isset($post) ? ($post->duration ?? 0) % 60 : '')" required/>
            <x-form.input-error :messages="$errors->get('duration_minutes')" class="mt-2"/>
        </div>
    </div>

    <div>
        <x-form.input-label for="track" :value="__('Upload track (.kml)')"/>
        <input type="file" id="track" name="track" accept=".kml"
               class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300"/>
        <x-form.input-error :messages="$errors->get('track')" class="mt-2"/>
    </div>
</div>
