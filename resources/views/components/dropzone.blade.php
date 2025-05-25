@props([
    'name' => 'image',
    'label' => __('Cover image'),
    'value' => '',
])

<div>
    <label class="block text-gray-700 font-medium mb-2">{{ $label }}</label>

    <div id="imagenDropzone"
        {{ $attributes->merge(['class' => 'dropzone border-dashed border-2 border-gray-300 rounded-lg p-6 text-center bg-gray-50 min-h-[200px] flex flex-col items-center justify-center cursor-pointer']) }}>
        <div class="dz-message text-gray-500 flex flex-col items-center">
            <i class="fas fa-upload text-3xl mb-2"></i>
            <span class="text-sm">Arrastra una imagen aqui o haz clic para seleccionar</span>
        </div>
    </div>

    <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}">
</div>

<style>
    #imagenDropzone .dz-preview .dz-image {
        border-radius: 0.5rem;
        overflow: hidden;
        max-height: 160px;
        width: auto;
    }

    #imagenDropzone .dz-preview .dz-image img {
        object-fit: contain;
        max-height: 160px;
    }

    #imagenDropzone .dz-details,
    #imagenDropzone .dz-progress,
    #imagenDropzone .dz-error-message,
    #imagenDropzone .dz-success-mark,
    #imagenDropzone .dz-error-mark,
    #imagenDropzone .dz-remove {
        display: none !important;
    }

    #imagenDropzone .dz-preview {
        display: flex;
        justify-content: center;
        margin-top: 0.5rem;
    }

    #imagenDropzone.dz-started .dz-message {
        display: none;
    }
</style>
