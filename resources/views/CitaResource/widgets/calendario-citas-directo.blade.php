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



<style>
    .fc-event-title {
        white-space: normal !important;
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
            //events: [],
            events: '/eventos',
            eventColor: '#3ab3d1  ',
            eventDisplay: 'block',
        });

        calendar.render();
    }); 
</script>