<form wire:submit.prevent="{{ $submitAction }}" enctype="multipart/form-data" class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
        <input wire:model.defer="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
        <x-form.trix-editor name="body" wire:model.defer="body"/>
        @error('body') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <x-form.select name="province" label="Provincia" :options="['' => __('Select a province')] + $provinces"
                       wire:model.defer="province" required/>
        @error('province') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <x-form.select name="difficulty" label="Dificultad" :options="['' => __('Select a difficulty')] + $difficulties"
                       wire:model.defer="difficulty" required/>
        @error('difficulty') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Longitude') }}</label>
        <input wire:model.defer="longitude" type="number"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('longitude') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Altitude') }}</label>
        <input wire:model.defer="altitude" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('altitude') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Duration') }}</label>
        <div class="flex space-x-2">
            <div class="flex-1">
                <input wire:model.defer="duration_hours" type="number" min="0" placeholder="Horas"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="flex-1">
                <input wire:model.defer="duration_minutes" type="number" min="0" max="59" placeholder="Minutos"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>
        @error('duration_hours') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        @error('duration_minutes') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
        <input wire:model="image" type="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ __('Track') }}</label>
        <input wire:model="track" type="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('track') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="flex space-x-2">
        <button type="submit" class="{{ $submitButtonClass }}">
            {{ __($submitButtonText) }}
        </button>

        @if(isset($showCancel) && $showCancel)
            <button type="button" wire:click="resetForm" @click="formMode = null"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                {{ __('Cancel') }}
            </button>
        @endif
    </div>
</form>
