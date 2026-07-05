<x-filament-panels::page>
    <div class="space-y-6">
        @if ($currentPhotoUrl)
            <div class="flex items-center gap-4">
                <img
                    src="{{ $currentPhotoUrl }}"
                    alt="Foto de perfil"
                    style="width: 80px; height: 80px; border-radius: 9999px; object-fit: cover;"
                >

                <div>
                    <p class="text-sm font-medium text-gray-950 dark:text-white">
                        Foto actual
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Esta es la imagen guardada en tu perfil.
                    </p>
                </div>
            </div>
        @endif

        <form wire:submit="save" class="space-y-6">
            {{ $this->form }}

            <x-filament::button type="submit">
                Guardar cambios
            </x-filament::button>
        </form>
    </div>
</x-filament-panels::page>