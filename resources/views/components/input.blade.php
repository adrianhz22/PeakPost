@props([
    'type' => 'text',
    'name',
    'value' => old($name),
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value }}"
    {{ $attributes->merge([
        'class' => 'w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300 focus:outline-none'
    ]) }}>
