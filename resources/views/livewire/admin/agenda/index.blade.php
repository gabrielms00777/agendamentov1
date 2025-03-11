<div>
    <!-- Breadcrumb -->
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Agenda', 'url' => route('admin.agenda.index')],
    ]" />

    <!-- Calendário -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div id="calendar" class="w-full"></div>
    </div>
</div>

<!-- Scripts do FullCalendar -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
    document.addEventListener('livewire:load', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: @json($events),
            eventClick: function(info) {
                alert('Agendamento: ' + info.event.title);
            }
        });
        calendar.render();
    });
</script>
@endpush