<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



@if(!auth()->user()->show_manual)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Aquí puedes mostrar una ventana modal o ejecutar un script -->
    <script>
        $(document).ready(function() {
            // Muestra la modal principal cuando se carga la página
            $('#myModal').modal('show');

            // Redirige a otra modal cuando se oculta la modal principal
            $('#myModal').on('hidden.bs.modal', function () {
                // Aquí decides a qué modal redirigir
                $('#includePackagesSectionModal').modal('show'); // Muestra la modal de includePackagesSection después de que se cierre la modal principal
            });

            // Desplázate hasta el final de la página solo después de que se cierre la modal de includePackagesSection
            $('#includePackagesSectionModal').on('hidden.bs.modal', function () {
                $('html, body').animate({ scrollTop: $(document).height() }, 'slow', function() {
                    // Una vez que el desplazamiento se ha completado, muestra la última modal
                    $('#SendToRequest').modal('show');
                });
            });
        });
    </script>

@endif
        <!-- Agrega aquí el código HTML para la ventana modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Instrucciones para solicitar un servicio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>"Select from our range of custom package options or take advantage of specially discounted packages tailored just for you.</p>
                        <img alt="Image placeholder" src="{{asset('img/requestcreate.PNG')}}" class="img-fluid">


                    </div>
                    <div class="modal-footer">
                        <form id="manualPreferenceForm" action="{{ url('manualPreference') }}" method="post">
                            @method('PUT') <!-- Agrega el método PUT -->
                            @csrf
                            <div class="form-check">
                                <input type="hidden" name="noMostrarManual" value="0"> <!-- Valor predeterminado, se enviará si el checkbox no está marcado -->
                                <input class="form-check-input" type="checkbox" id="noMostrarManual" name="noMostrarManual" value="1" onchange="updateCheckboxValue(this)">
                                    <label class="form-check-label" for="noMostrarManual">
                                        Hide this message in the future
                                    </label>
                                </div>
                        </form>
                        <button type="button" class="btn boton" data-dismiss="modal" onclick="submitForm()">Close</button> <!-- Cambiar a tipo "button" -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="includePackagesSectionModal" tabindex="-1" role="dialog" aria-labelledby="includePackagesSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="includePackagesSectionModalLabel">Instrucciones para seleccionar un paquete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>If you choose a personalized package, you'll enjoy the freedom to tailor the amount of each service according to your preferences. Otherwise, existing packages will be added as separate units.</p>
                        <img alt="Image placeholder" src="{{asset('img/requestcreate1.PNG')}}" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <form id="manualPreferenceForm" action="{{ url('manualPreference') }}" method="post">
                            @method('PUT') <!-- Agrega el método PUT -->
                            @csrf
                            <div class="form-check">
                                <input type="hidden" name="noMostrarManual" value="0"> <!-- Valor predeterminado, se enviará si el checkbox no está marcado -->
                                <input class="form-check-input" type="checkbox" id="noMostrarManual" name="noMostrarManual" value="1" onchange="updateCheckboxValue(this)">
                                    <label class="form-check-label" for="noMostrarManual">
                                        Hide this message in the future
                                    </label>
                                </div>

                        </form>
                        <button type="button" class="btn boton" data-dismiss="modal" onclick="submitForm()">Close</button> <!-- Cambiar a tipo "button" -->

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="SendToRequest" tabindex="-1" role="dialog" aria-labelledby="SendToRequestLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="SendToRequestLabel">Instrucciones para seleccionar un paquete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>After choosing your package, remember to submit your request promptly.</p>
                        <img alt="Image placeholder" src="{{asset('img/requestcreate2.PNG')}}" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <form id="manualPreferenceForm" action="{{ url('manualPreference') }}" method="post">
                            @method('PUT') <!-- Agrega el método PUT -->
                            @csrf
                            <div class="form-check">
                                <input type="hidden" name="noMostrarManual" value="0"> <!-- Valor predeterminado, se enviará si el checkbox no está marcado -->
                                <input class="form-check-input" type="checkbox" id="noMostrarManual" name="noMostrarManual" value="1" onchange="updateCheckboxValue(this)">
                                    <label class="form-check-label" for="noMostrarManual">
                                        Hide this message in the future
                                    </label>
                                </div>

                        </form>
                        <button type="button" class="btn boton" data-dismiss="modal" onclick="submitForm()">Close</button> <!-- Cambiar a tipo "button" -->

                    </div>
                </div>
            </div>
        </div>



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
                                <form action="{{url('/userServiceRequest')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                </div>                 
                    <div id="includeServicesSection" class="form-group" style="text-align:center;">                                            
                            @if (count($allServices) > 0)
                                    @foreach ($allServices as $service)
                                    <div class="container ServiceSection" style="padding:10px;" >                                    
                                            <h2> {{ $service->name }}</h2>
                                            <strong> Description: </strong> {{ $service->description }} <br> <br>
                                            <strong>Quantity: </strong><input type="number" name="service_quantity[{{ $service->id }}]" value="" class="quantity-input" readonly> <br><br>
                                            <strong>Service price:</strong>  $ {{ $service->price }} (xUnit)<br> <br>
                                            Add Service <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}"><br><br>
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
                                        <button type="submit" class="btn boton " style="margin: 14px 0px;">Send Request</button>
                                    </div>
                                </form>
                               
            </div>
        </div>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Agrega esto en tu plantilla Blade después de incluir jQuery -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var services = {!! json_encode($allServices->pluck('id')) !!}; // Obtén una lista de los IDs de los servicios

        services.forEach(function(serviceId) {
            var quantityInput = $("input[name='service_quantity[" + serviceId + "]']");
            var dateInput = $("#date" + serviceId); // Seleccione el elemento de fecha por ID único
            var checkbox = $("#service_" + serviceId);

            var fp = flatpickr(dateInput[0], {
                mode: 'multiple',
                dateFormat: 'Y-m-d',
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

<script >
        function updateCheckboxValue(checkbox) {
        if (checkbox.checked) {
            checkbox.value = "1"; // Si está marcado, cambia el valor a 1 (verdadero)
        } else {
            checkbox.value = "0"; // Si no está marcado, cambia el valor a 0 (falso)
        }
    }

    function submitForm() {
        var form = document.getElementById("manualPreferenceForm");
        var formData = new FormData(form);
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", form.action);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Acciones adicionales después de que el formulario se envíe con éxito
                console.log("Formulario enviado correctamente");
            }
        };
        xhr.send(formData);
    }
</script>


<script>
    $(document).ready(function () {
        $('input[type="checkbox"][name^="packages"]').change(function () {
            var packageId = $(this).attr('id').split('_')[1];
            var quantityInput = $('input[name="package_quantity[' + packageId + ']"]');
            

            if ($(this).prop('checked')) {
                quantityInput.val(1);
            } else {
                quantityInput.val('');
            }
        });
    });

</script>

@endsection








