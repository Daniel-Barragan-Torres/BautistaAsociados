<div>
    @if ($modalOpen && $cita)

        <x-filament::modal id="modal-detalle-cita" :visible="$modalOpen" width="lg" slide-over>
            <x-slot name="header">Detalles de la Cita</x-slot>

            <div class="space-y-2">
                <p><strong>Asunto:</strong> {{ $cita->asunto }}</p>
                <p><strong>Cliente:</strong> {{ $cita->cliente->nombre }}</p>
                <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                <p><strong>Hora:</strong> {{ $cita->hora }}</p>
            </div>

            <x-slot name="footer">
                <x-filament::button color="secondary" wire:click="cerrarModal">
                    Cerrar
                </x-filament::button>
            </x-slot>
        </x-filament::modal>


    @endif
</div>