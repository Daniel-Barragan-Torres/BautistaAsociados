@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.min.css" rel="stylesheet" />

<!-- FullCalendar Core + Plugins + Locales -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.global.min.js"></script>






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

<div id="event-modal" style="display:none;" class="modal-cita">
    <div class="modal-content">
        <h2 class="modal-title" id="modal-title">Asunto de la cita</h2>
        <div class="modal-row">
            <label>Cliente:</label>
            <span id="modal-client"></span>
        </div>
        <div class="modal-row">
            <label>Inicio:</label>
            <span id="modal-start"></span>
        </div>
        <div class="modal-row">
            <label>Fin:</label>
            <span id="modal-end"></span>
        </div>
        <div class="modal-actions">
            <button onclick="document.getElementById('event-modal').style.display='none'">Cerrar</button>
        </div>
    </div>
</div>

<style>
    /* MODALS */
    /* Fondo del modal */
    .modal-cita {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
        transition: background 0.4s ease;
    }

    /* Contenedor principal */
    .modal-cita .modal-content {
        background-color: #fff;
        border-radius: 14px;
        padding: 32px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        width: 480px;
        max-width: 90%;
        transform: translateY(-20px);
        opacity: 0;
        transition: all 0.35s ease;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    /* Animación de aparición */
    .modal-cita.show .modal-content {
        transform: translateY(0);
        opacity: 1;
    }

    /* Título centrado */
    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Filas de información */
    .modal-row {
        display: flex;
        gap: 10px;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .modal-row label {
        font-weight: 600;
        color: #444;
        min-width: 80px;
    }

    /* Botón */
    .modal-actions {
        margin-top: 24px;
        text-align: center;
    }

    .modal-actions button {
        background-color: #B8CD42;
        color: white;
        padding: 10px 24px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.25s ease, transform 0.2s ease;
    }

    .modal-actions button:hover {
        background-color: #a4bb38;
        transform: scale(1.05);
    }
</style>

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

    /* cerrar modal  */
    document.addEventListener('click', function (e) {
        const modal = document.getElementById('event-modal');
        const content = modal.querySelector('.modal-content');

        if (
            modal.classList.contains('show') &&
            !content.contains(e.target)
        ) {
            modal.classList.remove('show');
            modal.style.display = 'none';
        }
    });

    /* desmarcar highlitghts */
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.fc-event')) {
            document.querySelectorAll('.fc-event').forEach(el => {
                el.classList.remove('highlighted-event');
            });
        }
    });

    /* Calendario  */
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
            //events: [],
            events: '/eventos',
            eventColor: '#3ab3d1  ',
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

            /* click para el modal - detalle cita */
            eventClick: function (info) {
                const eventId = info.event.id;

                fetch(`/eventosdet?id=${eventId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Asegúrate de que la respuesta esté en data.eventos, o ajusta según el formato real
                        const evento = Array.isArray(data) ? data.find(e => e.id == eventId) : data;

                        document.getElementById('modal-title').textContent = evento.asunto || 'Sin asunto';
                        document.getElementById('modal-client').textContent = evento.cliente || 'Desconocido';
                        document.getElementById('modal-start').textContent = new Date(evento.start).toLocaleString();
                        document.getElementById('modal-end').textContent = new Date(evento.end).toLocaleString();

                        document.getElementById('event-modal').classList.add('show');
                        document.getElementById('event-modal').style.display = 'flex';
                    })
                    .catch(error => {
                        console.error('Error al obtener los detalles:', error);
                    });
            }


        });

        calendar.render();
    });


</script>