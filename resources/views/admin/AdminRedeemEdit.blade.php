<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
        /* Agrega estilos según tus necesidades */
        .error {
            color: red;
        }
    </style>

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit booking request</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('serviceRedems')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
            </div>
          </div>
        </div>
           <div class="card-body">
            @if($errors->any())
            @foreach($errors ->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please!!</strong> {{$error}}
            </div>
            @endforeach
            @endif
            <div class="container">
                <form action="{{url('/serviceRedems/store/'.$scheduled->id)}}" method="POST">                
                @csrf
                @method('PUT')
                    <div class="row ">
                        <div class="col-6">
                            <label for="name">Service Name:</label>
                            {{ $service->name }}
                        </div>
                        <div class="col-6 text-right">
                           Request Quantity: <span id="quantity">{{ $scheduled->quantity }}</span>
                            <span id="quantityError" class="error"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            Associated pets: <br> <br>
                            @foreach($pets as $pet)
                                {{$pet->name}}
                                <br>
                            @endforeach
                            <br>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="date">Estimated Date(s):</label>
                            <input type="text" name="date" id="date"  ><br>
                            <span id="dateError" class="error"></span>

                        </div>
                    <div class="col-6">
                        <label for="shift">Shift:</label>
                        <select name="shift" id="shift">
                            <option value="Any shift" {{ $scheduled->shift == 'Any shift' ? 'selected' : '' }}>Any shift</option>
                            <option value="morning" {{ $scheduled->shift == 'morning' ? 'selected' : '' }}>Morning Shift</option>
                            <option value="afternoon" {{ $scheduled->shift == 'afternoon' ? 'selected' : '' }}>Afternoon Shift</option>
                        </select><br>
                        <span id="shiftError" class="error"></span>
                    </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3">
                            <label for="address">Address :</label>
                            <input type="text" name="address" value="{{$scheduled->address}}" id="address" required>
                            
                        </div>
                        <div class="col-3">
                            <label for="comment">Comment:<br></label>
                            <input type="text" name="comment" id="comment" value="{{$scheduled->comment}}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <label for="walkers">Assign Scheduled to walker:</label><br>
                            <select  id="walkers" name="walkers">
                                <option value="">Select Walker</option>
                                @foreach ($allWalkers as $walker)
                                    <option value="{{ $walker->id }}">{{ $walker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quantity" class="d-none">Quantity:</label>
                        <input type="number" name="quantity" id="quantityForm"  class="d-none">
                    </div>
                    
                    <button type="submit" class="btn boton" >Assign Scheduled</button>
                </form>
            </div>
           </div>     
      </div>
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Agrega esto en tu plantilla Blade después de incluir jQuery -->
<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtén el elemento de cantidad
            var dateInput = document.getElementById('date');
            
            // Obtén las fechas preseleccionadas desde tu controlador de Laravel
            var preselectedDates = {!! json_encode($scheduledDates) !!};
            
            var fp = flatpickr(dateInput, {
                mode: 'multiple',
                dateFormat: 'Y-m-d',
                defaultDate: preselectedDates,  // Establece las fechas preseleccionadas
                onChange: function () {
                    // Actualiza la cantidad basada en la selección de fechas
                    updateQuantity();
                    // Valida si la cantidad de fechas seleccionadas es mayor que la cantidad disponible
                    validateDateQuantity();
                }
            });
        });
     
</script>
@endsection
