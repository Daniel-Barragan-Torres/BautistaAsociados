<!-- FullCalendar CDN -->

<!-- Estilos de FullCalendar -->
<!-- 
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet" />

FullCalendar JS (INCLUYE IDIOMAS) 
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>t>

<script src="{{ asset('js/fullcalendar-es.js') }}"></script> -->

<!-- FullCalendar CSS (local) -->
<link href="{{ asset('fullcalendar/index.min.css') }}" rel="stylesheet">

<!-- FullCalendar JS (local) -->
<script src="{{ asset('fullcalendar/index.global.min.js') }}"></script>

<!-- Idioma español forzado -->
<script src="{{ asset('fullcalendar/fullcalendar-es.js') }}"></script>



<!-- Calendario -->
<div id="calendar" style="min-height: 600px;" class="border rounded-md bg-white p-4 mt-6"></div>




<style>
    .fc-event-title {
        white-space: normal !important;
    }
</style>


<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            height: 600,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek',
            },
            //events: [],

            events: '/eventos',
            eventColor: '#B8CD42',
            eventDisplay: 'block',
        });

        calendar.render();
    }); 
</script> -->
<script>document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    setTimeout(() => {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            height: 600,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek',
            },
            events: '/eventos',
            eventColor: '#B8CD42',
            eventDisplay: 'block',
        });

        calendar.render();
    }, 50); // Da tiempo a que se registre el idioma
});
</script>