@props(['type' => 'submit'])

<button {{ $attributes->merge([
    'type' => $type,
    'class' => 'w-full bg-blue-600 text-white py-3 rounded-lg mt-6 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
