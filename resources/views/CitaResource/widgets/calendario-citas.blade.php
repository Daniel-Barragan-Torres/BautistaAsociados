<!-- Calendario -->
<div id="calendar" style="min-height: 600px;" class="border rounded-md bg-white p-4 mt-6"></div>

<!-- FullCalendar CSS y JS desde CDN correcta -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        if (!calendarEl) {
            console.error('No se encontró el elemento con id="calendar"');
            return;
        }

        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            height: 'auto',
            events: '/eventos', // Aquí tu endpoint Laravel
            eventDisplay: 'block',
        });

        calendar.render();
    });
</script>
