@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.min.css" rel="stylesheet" />

<!-- FullCalendar Core + Plugins + Locales -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.global.min.js"></script>



<x-filament::button wire:click="$dispatch('open-modal', { id: 'verCita', arguments: { recordId: 3 } })">
    Ver cita manual
</x-filament::button>



<!-- Calendario -->
<div id="calendar" style="min-height: 600px;" class="border rounded-md bg-white p-4 mt-6">

</div>

<div class="flex justify-end mt-4">

    <!-- crear cita -->
    <a href="{{ route('filament.dashboard.resources.citas.create') }}"
        class="inline-flex items-center px-4 py-2 bg-[#B8CD42] hover:bg-[#A4BA38] text-white text-sm font-medium rounded-lg shadow-md transition">
        <x-heroicon-o-plus class="w-5 h-5 mr-2" />
        Crear Cita
    </a>
</div>

<!-- Modal Event (beta) -Read -->


<!-- <div id="event-modal" style="display:none; position:fixed; top:20%; left:50%; transform:translateX(-50%);
    background:#fff; padding:20px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.2); z-index:9999;">
    <h3 id="modal-title"></h3>
    <p><strong>Inicio:</strong> <span id="modal-start"></span></p>
    <p><strong>Fin:</strong> <span id="modal-end"></span></p>
    <button onclick="document.getElementById('event-modal').style.display='none'">Cerrar</button>
</div>
 -->


<!-- Modal ver 2 -->




<style>
    .modal-cita,
    .modal-cita * {
        cursor: default !important;
        /* Evita el cursor tipo texto */
    }

    /* Evita cursor de texto en los eventos del calendario */
    .fc-event,
    .fc-event-main,
    .fc-daygrid-event,
    .fc-timegrid-event {
        cursor: pointer !important;
        user-select: none;
    }

    .fc-event-title {
        white-space: normal !important;

    }

    /* Solo para la vista mensual */
    .fc-daygrid-event .fc-event-time {
        display: block;
        font-weight: bold;
        font-size: 0.85rem;
        line-height: 1.2;
    }

    .fc-daygrid-event .fc-event-title {
        display: block;
        white-space: normal !important;
        overflow-wrap: break-word;
        word-break: break-word;
        text-overflow: ellipsis;
        font-size: 0.80rem;
        line-height: 1.1;
    }

    .fc-daygrid-event {
        padding: 2px 4px;
        height: auto !important;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Para la vista de lista (sin cambios) */
    .fc-list-event .fc-event-time,
    .fc-list-event .fc-event-title {
        display: inline !important;
        white-space: nowrap !important;
    }


    /*Semanas*/
    .fc-timegrid-event {
        margin-bottom: 4px !important;
        border-radius: 6px;
        padding: 2px 4px;
    }

    .fc-timegrid-event .fc-event-main {
        white-space: normal;
        font-size: 0.85rem;
    }

    /* Highlight events */
    .highlighted-event {
        z-index: 999 !important;
        transform: scale(1.05);
        transition: transform 0.2s ease;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.25);
        border: 2px solid gold;
    }

    /* Asegura que el contenido interno no se recorte ni se wrapee mal */
    .highlighted-event .fc-event-main {
        white-space: normal !important;
        overflow-wrap: break-word;
        word-break: break-word;
        line-height: 1.2;
        padding: 4px;
        font-size: 0.82rem;
    }


    /* ajuste de borde */
    .fc-timegrid-event {
        overflow: visible !important;
    }

    /* Asegura que las columnas puedan mostrar elementos expandidos */
    .fc-timegrid-col-frame {
        overflow: visible !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            lang: 'es',
            height: 600,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek',
            },
            events: '/eventos',
            eventColor: '#3ab3d1',
            eventDisplay: 'block',

            eventDidMount: function (info) {
                const title = info.event.title;

                // Tooltip con el título completo
                info.el.setAttribute('title', title);

                // Truncar visualmente si es demasiado largo
                const titleEl = info.el.querySelector('.fc-event-title');
                if (titleEl && title.length > 25) {
                    titleEl.textContent = title.slice(0, 22) + '...';
                }
            },
            

            eventClick: function (info) {
                const citaId = info.event.id;

                // Usar modal nativo de Filament
                Livewire.dispatch('open-modal', {
                    id: 'verCita', // nombre de tu Action
                    arguments: { recordId: citaId }
                });
            }
        });

        calendar.render();
    });
</script>