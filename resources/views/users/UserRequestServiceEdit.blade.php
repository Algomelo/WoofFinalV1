<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="card shadow">

        <div class="card-body">
           <h1> Your Woof adventure begins here </h1>  <h3>Choose any of the following options to start enjoying Woof, and we'll contact you right away.</h3>
            @if($errors->any())
            @foreach($errors ->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please!!</strong> {{$error}}
            </div>
            @endforeach
            @endif
        </div>
        <div class="container" >
    <div class="container-dialog" role="document">
        <div class="container-content" style="width:100%">
            <div class="container">    
                <div class="container d-block" style="justify-content: space-evenly;">             
                                 <div class="container botonespaquetes text-center">
                                    <div class="row">
                                        <div class="container col-6 d-flex">
                                        <a href="javascript:void(0);" onclick="showSection('includeServicesSection')" class="texto_servicio"style="margin:30px 30px; color:black;">Include Services (Create Custom Package) </a> 
                                        </div>
                                    </div>                                        
                                </div>
                                <form action="{{ url('/userServiceRequest/'.$serviceRequest->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div id="includeServicesSection" class="form-group" style="text-align:center;">                                            
                            @if (count($allServices) > 0)            
                            @foreach($serviceRequest->services as $service)
                                    <div class="container ServiceSection" style="padding:10px;" >                                          <br> 
                                            <h2> {{ $service->name }}</h2>                                        
                                            Description: {{ $service->description }} <br> <br>                                            
                                            <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="{{ $service->pivot->service_quantity }}"  class="quantity-input">
                                            Add Service <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" checked>
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-12">
                                                    <label for="date{{ $service->id }}">Estimated Date(s):</label><br>
                                                    <input type="text" name="dates[{{ $service->id }}][]" id="date{{ $service->id }}" class="date-input" style="border:solid 1px;"><br><br>
                                                    <span id="dateError{{ $service->id }}" class="error"></span>
                                                </div>                                  
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="shift">Shift:</label> <br>
                                                        <select name="shift" id="shift"><br>
                                                            <option value="" selected>Pick an option</option>
                                                            <option value="Any shift">Any shift</option>
                                                            <option value="morning">Morning Shift</option>
                                                            <option value="afternoon">Afternoon Shift</option>
                                                        </select><br>
                                                        <span id="shiftError" class="error"></span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="address">Address :</label> <br>
                                                       <input type="text" name="address" value="{{$userId->address}}" id="address" required style="border:solid 1px;">
                                                        
                                                    </div>
                                            </div>
                                    </div>
                                @endforeach                            
                            @else
                               <p>No hay Servicios disponibles.</p>
                            @endif
                       
                    </div>                
                                    </div>
                                    <div class="container d-block" style="text-align:center">
                                        <input name="comment" placeholder="Make a comment" type="text"  style="width:80%; height 15h; border-radius:3px; padding:30px"><br>
                                        <button type="submit" class="btn boton" style="margin: 14px 0px;">Send Request</button>
                                    </div>
                                </form>                               
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var services = {!! json_encode($allServices->pluck('id')) !!}; // Obtén una lista de los IDs de los servicios
        var preselectedDates = {!! json_encode($scheduledDates) !!};
        console.log(preselectedDates);
        services.forEach(function(serviceId) {
            var quantityInput = $("input[name='service_quantity[" + serviceId + "]']");
            var dateInput = $("#date" + serviceId); // Seleccione el elemento de fecha por ID único
            var checkbox = $("#service_" + serviceId);

            var fp = flatpickr(dateInput[0], {
                mode: 'multiple',
                dateFormat: 'Y-m-d',
                defaultDate: preselectedDates,  // Establece las fechas preseleccionadas
                onChange: function(selectedDates, dateStr, instance) {
                    quantityInput.val(selectedDates.length);
                    checkbox.prop('checked', selectedDates.length > 0);
                    var datesArray = selectedDates.map(function(date) {
                        return date.toISOString().split('T')[0]; // Formato YYYY-MM-DD
                    });
                    dateInput.attr('name', 'dates[' + serviceId + '][]').val(datesArray.join(','));

                }
            });
        });
    });
</script>


@endsection