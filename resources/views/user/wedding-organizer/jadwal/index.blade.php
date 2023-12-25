@extends('user.wedding-organizer.layout')

@section('title')
    <title>Jadwal | Wedding Marketplace</title>
@endsection

@section('h1', 'Jadwal')

@section('content')
    <div class="w-2/3"
        id="calendar"></div>
@endsection

@push('child-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                eventBackgroundColor: '#F78CA2',
                eventTextColor: '#FFFFFF',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridYear,dayGridMonth,dayGridWeek,dayGridDay'
                },
                weekNumbers: true,
            });
            calendar.render();
        });
    </script>
@endpush
