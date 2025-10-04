@extends('layouts.app')

@section('title', 'Citas en el Calendario')

@push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
@endpush

@section('content')
    <div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900">
                    <i class="fas fa-calendar-alt text-blue-600 mr-3"></i>Calendario de Citas
                </h1>
                <a href="{{ route('admin.appointments.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <i class="fas fa-plus mr-2 -ml-1"></i>
                    Agendar nueva cita
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 md:p-6 lg:p-8">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/moment.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/moment-timezone-with-data.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Configuración general del calendario para un look minimalista
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 'auto',
                headerToolbar: {
                    left: 'title',
                    center: '',
                    right: 'prev,next today dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                themeSystem: 'standard',
                dayMaxEvents: true, // "more" link
                
                // Carga de eventos
                events: {
                    url: '{{ route("admin.calendar.events") }}',
                    failure: function() {
                        alert('Hubo un error al cargar los eventos.');
                    }
                },

                // Manejo de eventos
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                },

                // Ajuste de los eventos para que el texto se adapte
                eventDisplay: 'block',
                eventDidMount: function(info) {
                    const eventTitle = info.el.querySelector('.fc-event-title');
                    if (eventTitle) {
                        eventTitle.textContent = info.event.title;
                        eventTitle.style.whiteSpace = 'normal'; // Allow text to wrap
                        eventTitle.style.overflow = 'hidden';
                        eventTitle.style.textOverflow = 'ellipsis';
                    }
                }
            });

            calendar.render();
        });
    </script>
@endpush