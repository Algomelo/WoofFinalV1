<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Redeem new service</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('users')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
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
            <form action="{{ route('user.RedemptionController.store', ['userId' => Auth::id(), 'redeemedServiceId' => $redeemedServices->id]) }}" method="post">
            @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                
                <div class="form-group">
                    <label for="name">Service Name:</label>
                    {{ $serviceName }}
                    <hr>
                </div>
                <div class="form-group">
                    Quantity: <span id="quantity">{{ $quantity }}</span>
                    <hr>
                </div>
                <div class="form-group">
                    Select Pets <br><br>
                    Please select the pets you would like to add to this service.<br><br>
                    @foreach ($pets as $pet)
                        <label for="pet_{{ $pet->id }}">
                            <input type="checkbox" name="pets[]" id="pet_{{ $pet->id }}" value="{{ $pet->id }}"  class="pet-checkbox">
                            {{ $pet->name }}<br>
                        </label>
                    @endforeach
                    <hr>
                </div>
                <div class="form-group">
                  <label for="date">Estimated Date:</label>
                  <input type="date" name="date" id="date" required>
                  <hr>
              </div>
              <div class="form-group">
                  <label for="shift">Pickup Addres:</label>
                  <input type="text" name="shift" id="shift" required>
              </div>
                <label for="quantity" class="d-none">Quantity:</label>
                <input type="number" name="quantity" id="quantityForm"  class="d-none">
                <button type="submit" class="btn btn-sm btn-primary">Schedule Service:</button>
            </form>
            
           </div>     
      </div>
 <!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<!-- Agrega esto en tu plantilla Blade antes de cerrar la etiqueta </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Agrega esto en tu plantilla Blade después de incluir jQuery -->
<script>
    document.addEventListener("DOMContentLoaded", function() {


        // Obtén el elemento de cantidad
        var quantityElement = document.getElementById('quantity');

        // Obtén todos los checkboxes con la clase 'pet-checkbox'
        var petCheckboxes = document.querySelectorAll('.pet-checkbox');




        // Añade un evento de cambio a cada checkbox
        petCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Actualiza la cantidad basada en la selección de checkboxes
                updateQuantity();

                // Valida si la cantidad de mascotas seleccionadas es mayor que la cantidad disponible
                validatePetQuantity();
            });
        });

        // Función para actualizar la cantidad
        function updateQuantity() {
            // Obtén la cantidad inicial desde Blade
            var quantity = parseInt("{{ $quantity }}");

            // Itera sobre los checkboxes y resta 1 a la cantidad por cada checkbox seleccionado
            petCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    quantity -= 1;

                }
            });

            // Actualiza el valor de la cantidad en el elemento de cantidad
            quantityElement.textContent = quantity;


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
</script>



@endsection
