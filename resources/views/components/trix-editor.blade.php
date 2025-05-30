@props([
    'name',
    'label' => '',
    'value' => '',
])

<div class="mb-4" wire:ignore x-data x-init="
    const trixInput = document.getElementById('{{ $name }}');
    $watch('$wire.{{ $attributes->wire('model')->value() }}', value => trixInput.value = value);
    document.addEventListener('trix-change', () => {
        $wire.set('{{ $attributes->wire('model')->value() }}', trixInput.value);
    });
">
    @if ($label)
        <label for="{{ $name }}" class="block text-gray-700 font-medium">
            {{ $label }}
        </label>
    @endif

    <input
        id="{{ $name }}"
        type="hidden"
        name="{{ $name }}"
        value="{{ $value }}"
    >

    <trix-editor
        input="{{ $name }}"
        {!! $attributes->merge(['class' => 'w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300 focus:outline-none']) !!}
    ></trix-editor>
</div>
