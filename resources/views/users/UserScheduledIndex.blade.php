<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css?v=1') }}">

<div class="card shadow">
        <div class="card-body d-flex justify-content-between">
        <h2>Booking Request</h2> <br>
            @if($errors->any())
            @foreach($errors ->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please!!</strong> {{$error}}
            </div>
            @endforeach
            @endif
        </div>
    <!-- Projects table -->
</div>

<div class="row" style="justify-content:center">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>                   
            </div>
        </div>
    </div>    
</div>

<div class="modal fade modalefecto" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true" >
     <div class="modal-dialog modalefecto" role="document">
        <div class="modal-content modalefecto">

            <div class="modal-header text-center d-block">
                <img src="img/brand/blue3.png" class="img-fluid" alt="..." style="max-height: 2rem;">
                <br> <br>
                <h3 class="modal-title" id="eventModalLabel">Scheduled</h3>
            </div>
            <div class="modal-body" id="eventModalBody">
                                            <!-- Aquí se mostrará la descripción del evento -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        displayEventTime: false, // Esto ocultará la hora de los eventos
        events: @json($formattedEvents),
        eventClick: function(info) {
            const modalBody = document.getElementById('eventModalBody');
            modalBody.innerText = info.event.extendedProps.description;
            $('#eventModal').modal('show'); // Mostrar la ventana modal
        }
    });
    calendar.render();
});
</script>



@endsection








