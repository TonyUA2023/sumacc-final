@extends('booking.layout')
@section('currentStep', 4)

@section('booking-content')
<div class="flex flex-col h-full">
    <div class="text-center mb-6 flex-shrink-0">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Select Date & Time</h2>
        <p class="text-slate-400 text-sm">Choose when you'd like us to serve you (Seattle Time)</p>
    </div>

    <div class="flex flex-col lg:grid lg:grid-cols-2 gap-4 md:gap-6 flex-grow overflow-hidden">
        {{-- Columna del Calendario --}}
        <div class="bg-slate-800/30 rounded-xl p-4 md:p-6 border border-slate-700/50 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <button type="button" id="prev-month" class="p-2 rounded-lg bg-slate-700/50 hover:bg-slate-700 transition-colors" aria-label="Previous month">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <h5 class="text-white font-semibold text-lg" id="current-month"></h5>
                <button type="button" id="next-month" class="p-2 rounded-lg bg-slate-700/50 hover:bg-slate-700 transition-colors" aria-label="Next month">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
            
            <div class="grid grid-cols-7 gap-1 text-center text-xs text-slate-400 mb-2">
                @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div>{{ $day }}</div>
                @endforeach
            </div>
            
            <div id="calendar-days" class="grid grid-cols-7 gap-1">
                {{-- JavaScript llenará los días aquí --}}
            </div>
        </div>

        {{-- Columna de Horarios y Formulario --}}
        <div class="flex flex-col">
            <div class="bg-slate-800/30 rounded-xl p-4 md:p-6 border border-slate-700/50 flex-grow mb-4 overflow-y-auto">
                <h4 class="text-lg font-semibold text-white mb-4">Available Time Slots</h4>
                <p class="text-slate-400 text-sm mb-4">Selected date: <span class="text-white font-medium" id="selected-date-display">Please select a date</span></p>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="time-slots-container">
                    <div class="col-span-full text-center py-8 text-slate-400">
                        Please select a date to see available time slots.
                    </div>
                </div>
            </div>

            <form action="{{ route('booking.storeStep4') }}" method="POST" id="datetime-form">
                @csrf
                <input type="hidden" name="selected_date" id="selected_date_input" value="{{ session('booking.datetime') ? \Carbon\Carbon::parse(session('booking.datetime'))->format('Y-m-d') : '' }}">
                <input type="hidden" name="selected_time" id="selected_time_input" value="{{ session('booking.datetime') ? \Carbon\Carbon::parse(session('booking.datetime'))->format('H:i') : '' }}">
                
                <div class="flex justify-between items-center">
                    <a href="{{ route('booking.step3') }}" class="bg-slate-700/50 text-slate-300 py-3 px-6 rounded-lg hover:bg-slate-700/70 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Previous
                    </a>
                    <button type="submit" id="continue-button" disabled class="bg-slate-600 text-slate-400 py-3 px-8 rounded-lg font-semibold flex items-center cursor-not-allowed transition-colors">
                        Continue to Details
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const monthYearElement = document.getElementById('current-month');
    const calendarDays = document.getElementById('calendar-days');
    const timeSlotsContainer = document.getElementById('time-slots-container');
    const selectedDateDisplay = document.getElementById('selected-date-display');
    const dateInput = document.getElementById('selected_date_input');
    const timeInput = document.getElementById('selected_time_input');
    const continueButton = document.getElementById('continue-button');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    
    let currentDate = new Date();
    let selectedDate = dateInput.value ? new Date(dateInput.value + 'T12:00:00') : null;
    let selectedTime = timeInput.value || null;

    function renderCalendar() {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        
        monthYearElement.textContent = new Date(year, month).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        calendarDays.innerHTML = '';

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDayOfMonth; i++) {
            calendarDays.innerHTML += '<div></div>';
        }

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        for (let day = 1; day <= daysInMonth; day++) {
            const dayDate = new Date(year, month, day);
            const dayButton = document.createElement('button');
            dayButton.textContent = day;
            dayButton.type = 'button';
            dayButton.classList.add('w-10', 'h-10', 'rounded-full', 'transition-colors', 'duration-200');
            
            const isPast = dayDate < today;
            // CAMBIO 1: Se eliminó la variable 'isSunday' de la condición para deshabilitar.
            const isSelected = selectedDate && dayDate.toDateString() === selectedDate.toDateString();

            if (isPast) { // Ahora solo deshabilita los días pasados
                dayButton.disabled = true;
                dayButton.classList.add('text-slate-600', 'cursor-not-allowed');
            } else if (isSelected) {
                dayButton.classList.add('bg-blue-500', 'text-white', 'font-bold');
            } else {
                dayButton.classList.add('text-slate-300', 'hover:bg-slate-700');
            }
            
            dayButton.addEventListener('click', () => handleDateClick(dayDate));
            calendarDays.appendChild(dayButton);
        }
    }

    function handleDateClick(date) {
        selectedDate = date;
        selectedTime = null;
        dateInput.value = formatDate(date);
        timeInput.value = '';
        
        selectedDateDisplay.textContent = date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        
        renderCalendar();
        fetchAvailableSlots(date);
        updateContinueButtonState();
    }

    function fetchAvailableSlots(date) {
        timeSlotsContainer.innerHTML = `<div class="col-span-full text-center py-8 text-slate-400">Loading...</div>`;
        const dateString = formatDate(date);

        fetch(`{{ route('booking.getAvailableSlots') }}?date=${dateString}`)
            .then(response => response.json())
            .then(slots => {
                timeSlotsContainer.innerHTML = '';
                if (slots.length > 0) {
                    slots.forEach(slot => {
                        const timeButton = document.createElement('button');
                        timeButton.type = 'button';
                        timeButton.textContent = formatTime(slot);
                        timeButton.classList.add('w-full', 'text-center', 'py-3', 'rounded-lg', 'border', 'transition-colors', 'duration-200', 'bg-slate-700/50', 'border-slate-700', 'text-slate-300', 'hover:border-blue-500');
                        timeButton.setAttribute('data-time', slot); // Atributo para re-selección

                        if (slot === selectedTime) {
                             timeButton.classList.remove('bg-slate-700/50', 'border-slate-700', 'text-slate-300');
                             timeButton.classList.add('bg-blue-500', 'border-blue-500', 'text-white', 'font-bold');
                        }
                        
                        timeButton.addEventListener('click', () => handleTimeClick(slot, timeButton));
                        timeSlotsContainer.appendChild(timeButton);
                    });
                } else {
                    timeSlotsContainer.innerHTML = `<div class="col-span-full text-center py-8 text-slate-400">No available slots for this date.</div>`;
                }
            })
            .catch(error => {
                console.error('Error fetching slots:', error);
                timeSlotsContainer.innerHTML = `<div class="col-span-full text-center py-8 text-red-400">Error loading times.</div>`;
            });
    }

    function handleTimeClick(time, buttonElement) {
        selectedTime = time;
        timeInput.value = time;

        document.querySelectorAll('#time-slots-container button').forEach(btn => {
            btn.classList.remove('bg-blue-500', 'border-blue-500', 'text-white', 'font-bold');
            btn.classList.add('bg-slate-700/50', 'border-slate-700', 'text-slate-300');
        });

        buttonElement.classList.remove('bg-slate-700/50', 'border-slate-700', 'text-slate-300');
        buttonElement.classList.add('bg-blue-500', 'border-blue-500', 'text-white', 'font-bold');

        updateContinueButtonState();
    }

    function updateContinueButtonState() {
        if (selectedDate && selectedTime) {
            continueButton.disabled = false;
            continueButton.classList.remove('bg-slate-600', 'text-slate-400', 'cursor-not-allowed');
            continueButton.classList.add('bg-blue-500', 'hover:bg-blue-600', 'text-white');
        } else {
            continueButton.disabled = true;
            continueButton.classList.add('bg-slate-600', 'text-slate-400', 'cursor-not-allowed');
            continueButton.classList.remove('bg-blue-500', 'hover:bg-blue-600', 'text-white');
        }
    }

    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }
    
    function formatTime(time24) {
        const [hour, minute] = time24.split(':');
        const h = parseInt(hour, 10);
        const ampm = h >= 12 ? 'PM' : 'AM';
        const hour12 = h % 12 || 12;
        return `${hour12}:${minute} ${ampm}`;
    }

    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    // CAMBIO 2: Lógica de inicialización actualizada
    function initializeCalendar() {
        if (selectedDate) {
            // Si ya hay una fecha en la sesión, la usamos (ej. al volver de otro paso)
            currentDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), 1);
            handleDateClick(selectedDate);
            if (selectedTime) {
                // Pequeño retraso para asegurar que los slots se hayan renderizado antes de seleccionar uno
                setTimeout(() => {
                    const timeButton = document.querySelector(`#time-slots-container button[data-time="${selectedTime}"]`);
                    if (timeButton) handleTimeClick(selectedTime, timeButton);
                }, 300);
            }
        } else {
            // Si no hay fecha en sesión, seleccionamos el día de hoy por defecto
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            currentDate = new Date(today.getFullYear(), today.getMonth(), 1);
            handleDateClick(today); // Esto selecciona la fecha y carga los horarios
        }
    }
    
    initializeCalendar();
});
</script>
@endsection