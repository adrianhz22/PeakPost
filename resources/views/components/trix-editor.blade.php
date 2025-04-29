@props([
    'name',
    'label' => '',
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-gray-700 font-medium">
            {{ $label }}
        </label>
    @endif

    <input id="{{ $name }}" type="hidden" name="{{ $name }}">

    <trix-editor
        input="{{ $name }}"
        {!! $attributes->merge(['class' => 'w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300 focus:outline-none']) !!}
    ></trix-editor>
</div>
