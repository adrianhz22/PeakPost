@props([
    'name' => 'image',
    'label' => __('Cover image'),
])

<div>
    <label class="block text-gray-700 font-medium">{{ $label }}</label>

    <div id="imagenDropzone"
        {{ $attributes->merge(['class' => 'dropzone border-dashed border-2 border-gray-300 rounded-lg p-4 text-center bg-gray-50']) }}>
    </div>

    <input type="hidden" name="{{ $name }}">
</div>
