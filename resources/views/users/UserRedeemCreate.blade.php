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
              <h3 class="mb-0">Redeem new service</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('users')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
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
                <form action="{{ route('user.RedemptionController.store', ['userId' => Auth::id(), 'redeemedServiceId' => $redeemedServices->id]) }}"  id="myForm"  method="post">
                @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    
                    <div class="row ">
                        <div class="col-6">
                            <label for="name">Service Name:</label>
                            {{ $serviceName }}
                        </div>
                        <div class="col-6 text-right">
                            Quantity: <span id="quantity">{{ $quantity }}</span>
                            <span id="quantityError" class="error"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            Select Pets :
                            Please select the pets you would like to add to this service.<br><br>
                            @foreach ($pets as $pet)
                                <label for="pet_{{ $pet->id }}">
                                    <input type="checkbox" name="pets[]" id="pet_{{ $pet->id }}" value="{{ $pet->id }}"  class="pet-checkbox"  >
                                    {{ $pet->name }} //
                                </label>
                            @endforeach
                            <br>
                            <span id="petsError" class="error"></span>

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
                                <option value="" selected>Pick an option</option>
                                <option value="Any shift">Any shift</option>
                                <option value="morning">Morning Shift</option>
                                <option value="afternoon">Afternoon Shift</option>
                            </select><br>
                            <span id="shiftError" class="error"></span>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3">
                            <label for="address">Address :</label>
                            <input type="text" name="address" value="{{$user->address}}" id="address" required>
                            (Please confirm your address)
                            
                        </div>
                        <div class="col-3">
                            <label for="comment">Comment:<br></label>
                            <input type="text" name="comment" id="comment">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="quantity" class="d-none">Quantity:</label>
                        <input type="number" name="quantity" id="quantityForm"  class="d-none">
                    </div>
                    
                    <button type="button" class="btn boton" onclick="validateForm()">Schedule Service</button>
                </form>
            </div>
            
           </div>     
      </div>
 <!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Agrega esto en tu plantilla Blade después de incluir jQuery -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén el elemento de cantidad
        var dateInput = document.getElementById('date');
        var fp = flatpickr(dateInput, {
            mode: 'multiple',
            dateFormat: 'Y-m-d',
            onChange: function () {
                // Actualiza la cantidad basada en la selección de fechas
                updateQuantity();

                // Valida si la cantidad de fechas seleccionadas es mayor que la cantidad disponible
                validateDateQuantity();
            }
        });
        var quantityElement = document.getElementById('quantity');
        // Obtén todos los checkboxes con la clase 'pet-checkbox'
        var petCheckboxes = document.querySelectorAll('.pet-checkbox');
        // Añade un evento de cambio a cada checkbox
        dateInput.addEventListener('change', function () {
            // Actualiza la cantidad basada en la selección de fechas
            updateQuantity();

            // Valida si la cantidad de fechas seleccionadas es mayor que la cantidad disponible
            validateDateQuantity();
        });
        petCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Actualiza la cantidad basada en la selección de checkboxes
                updateQuantity();

                // Valida si la cantidad de mascotas seleccionadas es mayor que la cantidad disponible
                validatePetQuantity();
            });
        });

        // Función para actualizar la cantidad


        function validateDateQuantity() {
            // Obtén la cantidad de fechas seleccionadas
            var selectedDateCount = dateInput.value.split(',').filter(Boolean).length;

            // Obtén la cantidad disponible
            var availableQuantity = parseInt("{{ $quantity }}");

            // Si la cantidad de fechas seleccionadas es mayor que la cantidad disponible, muestra un mensaje y elimina la última fecha
            if (selectedDateCount > availableQuantity) {
                alert("The number of selected dates exceeds the available quantity.");
                // Elimina la última fecha seleccionada
                dateInput.value = dateInput.value.split(',').slice(0, -1).join(',');
                // Actualiza la cantidad nuevamente
                updateQuantity();
            }
        }
        // Función para validar la cantidad de mascotas seleccionadas
        function validatePetQuantity() {
            // Obtén la cantidad de mascotas seleccionadas
            var selectedPetCount = document.querySelectorAll('.pet-checkbox:checked').length;

            // Obtén la cantidad disponible
            var availableQuantity = parseInt("{{ $quantity }}");

            // Si la cantidad de mascotas seleccionadas es mayor que la cantidad disponible, muestra un mensaje y deselecciona el último checkbox
            if (selectedPetCount > availableQuantity) {
                alert("The number of associated pets exceeds the available number of services.");
                // Deselecciona el último checkbox
                petCheckboxes[petCheckboxes.length - 1].checked = false;
                // Actualiza la cantidad nuevamente
                updateQuantity();
            }
        }
        function updateQuantity() {
        // Obtén la cantidad inicial desde Blade
        var quantity = parseInt("{{ $quantity }}");
        // Obtén la cantidad de fechas seleccionadas
        var selectedDateCount = dateInput.value.split(',').filter(Boolean).length;
        // Obtén la cantidad de mascotas seleccionadas
        var selectedPetCount = document.querySelectorAll('.pet-checkbox:checked').length;
        // Calcula la cantidad a restar teniendo en cuenta la combinación de fechas y mascotas seleccionadas
        var subtractionAmount = selectedDateCount * selectedPetCount;
        // Calcula el nuevo valor de cantidad
        var newQuantity = quantity - subtractionAmount;
        // Validación: Muestra una alerta si la cantidad es 0 o menor
        if (newQuantity < 0) {
            alert("Apologies, but the available quantity is insufficient. Please adjust your selection. Note: The selected quantity is calculated based on the combination of selected dates and pets.");
            if (selectedDateCount > 0) {
            // Puedes ajustar esta lógica dependiendo de la implementación de tu calendario
            // Esto podría implicar reiniciar la instancia del calendario o cualquier método específico para deseleccionar días.
            fp.clear();
            }
            // Otras acciones que puedas necesitar, como deshabilitar el botón de envío, etc.
        } else {
            // Actualiza el valor de la cantidad en el elemento de cantidad
            quantityElement.textContent = newQuantity;
            var quantityFormInput = document.getElementById('quantityForm');
            quantityFormInput.value = quantity - newQuantity;
        }
    }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener referencia al input y a los checkboxes
        var valorInput = document.getElementById('quantityForm');
        var checkboxes = document.querySelectorAll('.pet-checkbox');

        // Añadir un event listener a cada checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Calcular el nuevo valor sumando la cantidad de checkboxes seleccionados
                var nuevoValor = 0;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        nuevoValor++;
                    }
                });

                // Actualizar el valor del input
                valorInput.value = nuevoValor;
            });
        });
    });

        function validateForm() {
            var dateInput = document.getElementById('date');
            var dateError = document.getElementById('dateError');
            var petCheckboxes = document.querySelectorAll('.pet-checkbox');
            var petsError = document.getElementById('petsError');
            var shiftSelect = document.getElementById('shift');
            var shiftError = document.getElementById('shiftError');

            // Validación de la fecha
            if (dateInput.value.trim() === '') {
                dateError.innerHTML = 'Please enter a date';
            } else {
                dateError.innerHTML = '';
            }

            // Validación de al menos un checkbox de mascota seleccionado
            var atLeastOnePetSelected = Array.from(petCheckboxes).some(function(checkbox) {
                return checkbox.checked;
            });

            if (!atLeastOnePetSelected) {
                petsError.innerHTML = 'Please select at least one pet';
            } else {
                petsError.innerHTML = '';
            }

 

            if (shiftSelect.value === '') {
                shiftError.innerHTML = 'Please pick a shift';
            } else {
                shiftError.innerHTML = '';
            }
                       // Envía el formulario si ambas validaciones son exitosas
            if (dateError.innerHTML === '' && petsError.innerHTML === '' && shiftError.innerHTML === '') {
                document.getElementById('myForm').submit();
            }
        }


</script>



@endsection
