@props([
    'name' => '',
    'value' => old($name),
    'required' => false,
    'disabled' => false,
])

<textarea
    name="{{ $name }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300 focus:outline-none']) !!}
>{{ $value }}</textarea>
