@props([
    'name',
    'label',
    'options' => [],
    'placeholder' => 'Select an option',
    'selected' => null,
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 font-medium">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}"
            class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
        <option value="" selected disabled>{{ $placeholder }}</option>
        @foreach($options as $value => $optionLabel)
            <option value="{{ $value }}" {{ $value == old($name, $selected) ? 'selected' : '' }}>
            {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
