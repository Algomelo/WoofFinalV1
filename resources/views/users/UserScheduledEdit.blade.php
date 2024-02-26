<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css?v=1') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
        /* Agrega estilos según tus necesidades */
        .error {
            color: red;
        }
    </style>
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
                        <p>In this section, you can redeem the selected service. Please ensure all fields are filled out, and if you haven't already, include your pet in the pets section.</p>
                        <img alt="Image placeholder" src="{{asset('img/redemcreate.PNG')}}" class="img-fluid">


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
                        <p>It's essential to select the number of pets and the desired redemption duration for your services. Remember, each selected pet and day will deduct the corresponding unit from the available service.</p>
                        <img alt="Image placeholder" src="{{asset('img/redemcreate1.PNG')}}" class="img-fluid">
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
                        <p>Please remember to submit your request so that we can receive your information and schedule your service. (Keep in mind that once your request is scheduled, you can view it in the schedules section.)</p>
                        <img alt="Image placeholder" src="{{asset('img/redemcreate2.PNG')}}" class="img-fluid">
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
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Redeem new service</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('userRedemption')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
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

                <form action="{{ url('/userScheduled/'.$scheduled->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row ">
                        <div class="col-4">
                            <label for="name">Service Name:</label>
                            {{ $scheduled->nameservice }}
                        </div>
                        <div class="col-4 text-center">
                            # Scheduled: <span id="unique_number">{{ $scheduled->unique_number }}</span>
                        </div>
                        <div class="col-4 text-right">
                            Quantity: <span id="quantity">{{ $scheduled->quantity }}</span>
                            <span id="quantityError" class="error"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            Associated pets:
                            <br><br>
                            {{$scheduled->namepets}}
                            <br>
                            <span id="petsError" class="error"></span>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="date">Estimated Date(s):</label><br>
                            <input type="text" name="date" id="date" style="border:solid 1px;"  ><br><br>
                            <span id="dateError" class="error"></span>

                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="shift">Shift:</label> <br>
                            <select name="shift" id="shift"><br>
                                <option value="" {{ $scheduled->shift == '' ? 'selected' : '' }}>Pick an option</option>
                                <option value="Any shift" {{ $scheduled->shift == 'Any shift' ? 'selected' : '' }}>Any shift</option>
                                <option value="morning" {{ $scheduled->shift == 'morning' ? 'selected' : '' }}>Morning Shift</option>
                                <option value="afternoon" {{ $scheduled->shift == 'afternoon' ? 'selected' : '' }}>Afternoon Shift</option>
                            </select><br>
                            <span id="shiftError" class="error"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="address">Address :</label> <br>
                            <input type="text" name="address" value="{{$scheduled->address}}" id="address" required style="border:solid 1px;">
                            (Please confirm your address) <br><br>
                            
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="comment">Comment:</label> <br>
                            <input type="text" name="comment" value="{{$scheduled->comment}}"id="comment" style="border:solid 1px;">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quantity" class="d-none">Quantity:</label>
                        <input type="number" name="quantity" id="quantityForm"  class="d-none">
                    </div>
                    
                    <button type="submit" class="btn boton" >Schedule Service</button>
                </form>
            </div>
            
           </div>     
      </div>
 <!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                    calculateTotal();
                }
            });
    // Esta función se ejecuta cada vez que se produce un cambio en el campo de fechas
    function calculateTotal() {
        var scheduledQuantity = <?php echo json_encode($scheduled->quantity); ?>;
        var scheduledPets = "<?php echo $scheduled->namepets; ?>";
        var selectedDates = document.getElementById('date').value;
        
        var petArray = scheduledPets.split(',');
        var petCount = petArray.length;
        var selectedDatesCount = selectedDates.split(',').length;
        var count = selectedDatesCount * petCount;

        // Actualiza el mensaje de error si la cantidad total es mayor que la cantidad programada
        if (count > scheduledQuantity) {
            document.getElementById('dateError').innerText = "The selected dates cannot exceed the quantity of " + scheduledQuantity + ".";
        } else {
            document.getElementById('dateError').innerText = "";
        }
    }


});
</script>



@endsection
