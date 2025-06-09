<x-filament-panels::page>
    <!-- Componentes livewire -->

    <div> <!-- Este div envuelve TODO -->

        <livewire:widgets.calendario-citas />
        <livewire:cita-detalles-modal />

        <script>
            window.addEventListener('abrir-modal-cita', event => {
                Livewire.emit('mostrarCita', event.detail.id);
            });

            window.addEventListener('DOMContentLoaded', function () {
                // Espera un momento tras cargar para obtener el calendario
                setTimeout(() => {
                    const calendarEl = document.querySelector('[data-calendar-id]');
                    if (calendarEl) {
                        const calendar = FullCalendar.getCalendar(calendarEl);
                        if (calendar) {
                            window.calendario = calendar;
                            console.log('🗓️ Calendario FullCalendar disponible en window.calendario');
                        }
                    }
                }, 500); // pequeño delay por Livewire render
            });
            window.addEventListener('close-modal', function () {
                if (window.calendario) {
                    console.log('[🌀] Modal cerrado → recargando eventos del calendario');
                    window.calendario.refetchEvents(); // 💥 MAGIA
                }
            });
        </script>

    </div>
</x-filament-panels::page>