@extends('layout.layout') 

@section('title', 'Calendrier des Réservations')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold m-0">
                    <i class="bi bi-calendar3 text-primary me-2"></i>Planning Général
                </h4>
            </div>

            <div id="calendar" style="min-height: 700px;"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/fr.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        const calendar = new FullCalendar.Calendar(calendarEl, {
            // Configuration du Bundle Standard
            initialView: 'timeGridWeek',
            locale: 'fr',
            firstDay: 1, 
            slotMinTime: '08:00:00', 
            slotMaxTime: '23:59:00', 
            allDaySlot: false,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: "Aujourd'hui",
                month: "Mois",
                week: "Semaine",
                day: "Jour"
            },
            
            // Chargement des événements
            events: @json($events),            
            // Style
            eventTimeFormat: { 
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false,
                hour12: false
            }
        });

        calendar.render();
    });
</script>

<style>
    :root {
        --fc-border-color: #f1e8da;
        --fc-button-bg-color: #ff7a00;
        --fc-button-border-color: #ff7a00;
        --fc-button-hover-bg-color: #e66e00;
        --fc-today-bg-color: rgba(255, 226, 191, 0.3);
    }

    .fc .fc-toolbar-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #333;
    }

    .fc .fc-button-primary:disabled {
        background-color: #ffb366;
        border-color: #ffb366;
    }

    .fc-event {
        cursor: pointer;
        padding: 2px 5px;
        border-radius: 4px;
        font-size: 0.85rem;
    }
</style>
@endsection