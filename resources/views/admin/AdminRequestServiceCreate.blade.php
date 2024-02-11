<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<style>
 


    
</style>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">






<div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                <h3 class="mb-0">Create Request Service </h3>
                </div>
                <div class="col text-right">
                <a href="{{ url('serviceRequests')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
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
        </div>
        <div class="container" >
    <div class="container-dialog" role="document">
        <div class="container-content" style="width:100%">

            <div class="container">

        
                <div class="container d-block" style="justify-content: space-evenly;">
             
    <div class="form-group" >

    <form action="{{url('/serviceRequests')}}" method="POST">

                                 
                                 @csrf
            <div class="form-group">
                <label for="assigned_user">Assign to User:</label>
                    <select class="form-control" id="assigned_user" name="assigned_user">
                        <option value="">Select User</option>
                        @foreach ($allUsers as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

            </div>


            <div class="form-group">
                <label for="state">State</label>
                <select name="state" class="form-control">

                    <option value="pending">Pending</option>

                    <option value="Approved">Approved</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <input type="text" name="comment" class="form-control" value="{{ old('comment') }}">
            </div>



            <div class="form-group">
                <h4>Please select Services:</h4>
                <div class="container d-block" >
                @foreach($allServices as $service)
                    
                        <label for="service_{{ $service->id }}">
                            <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" class="service-checkbox">
                            Name Service : {{ $service->name }} 
                        </label>
                        <label for="service_{{ $service->id }}">

                            Price Service:  $ {{ $service->price }}  (xUnit)

                         </label>
                         <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="" class="quantity-input"><hr>
                         <span class="service-price" style="display:none;">{{ $service->price }}</span>

                   
                @endforeach
                </div>

            </div>

            <div class="form-group">
                <h4>Please select Packages:</h4>
                @foreach($allPackages as $package)
                <div class="container d-block" >

                    <label for="package_{{ $package->id }}">
                        <input type="checkbox" name="packages[]" value="{{ $package->id }}" id="package_{{ $package->id }}" class="service-checkbox">
                        Name Package : {{ $package->name }}
                    </label>
                    <label for="package_{{ $package->id }}">
                        Price Package:  $ {{ $package->price }}  (xUnit)
                        <input type="number" name="package_quantity[{{ $package->id }}]" placeholder="Quantity" value="" class="quantity-input d-none">
                        <span class="service-price" style="display:none;">{{ $package->price }}</span> 
                    </label>
                    <hr>

                </div>
                @endforeach

            </div>
            <div id="total-price"><strong>Total Price: $0</strong></div> <br>

            <div class="form-group">
                <label for="custom_price">Enable Custom Price</label>
                <input type="checkbox" name="custom_price" id="custom_price" onchange="toggleCustomPrice()">
            </div>



            <div class="form-group">

                <label for="price">Custom Price</label>
                <input type="number" name="price" class="form-control" value="" id="price-input" disabled>
            </div>


            <button type="submit" class="btn boton">Assign request</button>
        </form>

                               
            </div>
        </div>
    </div>


</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

        showSection("includeServicesSection");

        function showSection(sectionId) {
            // Oculta todas las secciones
            document.getElementById('includePackagesSection').style.display = 'none';
            document.getElementById('includeServicesSection').style.display = 'none';

            // Muestra la sección correspondiente al ID recibido como parámetro
            document.getElementById(sectionId).style.display = 'block';

            // Declara e inicializa las variables antes de acceder a sus propiedades
            var textoPaquete = document.getElementsByClassName('texto_paquete')[0];
            var textoServicio = document.getElementsByClassName('texto_servicio')[0];

            // Cambia el color del texto y del fondo para reflejar la sección activa
            if (sectionId == "includePackagesSection") {
                textoPaquete.style.color = '#fff';
                textoPaquete.style.backgroundColor = "#F2761D";
                textoServicio.style.backgroundColor = "#fff";
                textoServicio.style.color = 'black'; // Cambia el color del otro enlace
            } else if (sectionId == "includeServicesSection") {
                textoServicio.style.color = 'white';
                textoServicio.style.backgroundColor = "#F2761D";
                textoPaquete.style.backgroundColor = "#fff";
                textoPaquete.style.color = 'black'; // Cambia el color del otro enlace
            }
        }
</script>

<script>

</script>


<script>
    $(document).ready(function () {
        $('input[type="checkbox"][name^="packages"]').change(function () {
            var packageId = $(this).attr('id').split('_')[1];
            var quantityInput = $('input[name="package_quantity[' + packageId + ']"]');

            if ($(this).prop('checked')) {
                quantityInput.val(1);
                updateTotalPrice()
            } else {
                quantityInput.val('');
            }
        });
    });

    const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const servicePrices = document.querySelectorAll('.service-price');
    const totalPriceElement = document.getElementById('total-price');
    const priceInput = document.getElementById('price-input');
    const enableCustomPriceCheckbox = document.getElementById('custom_price');

    function toggleCustomPrice() {
        // Habilitar o deshabilitar el campo "Custom Price" según el estado del checkbox
        priceInput.disabled = !enableCustomPriceCheckbox.checked;

        // Limpiar los event listeners para evitar la duplicación
        serviceCheckboxes.forEach((checkbox, index) => {
            checkbox.removeEventListener('change', updateTotalPrice);
            quantityInputs[index].removeEventListener('input', updateTotalPrice);
        });

        // Añadir event listeners dependiendo del estado del checkbox
        if (!enableCustomPriceCheckbox.checked) {
            serviceCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', updateTotalPrice);
                quantityInputs[index].addEventListener('input', updateTotalPrice);
            });
        } else {
            priceInput.addEventListener('input', updateTotalPrice);
        }
    }

    serviceCheckboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', updateTotalPrice);
        quantityInputs[index].addEventListener('input', updateTotalPrice);
    });

    priceInput.addEventListener('input', updateTotalPrice);

    function updateTotalPrice() {
        let totalPrice = 0;

        // Verifica si price-input tiene un valor válido.
        const enteredPrice = parseFloat(priceInput.value);
        if (!isNaN(enteredPrice)) {
            totalPrice = enteredPrice; // Utiliza el valor ingresado en price-input.
        } else {
            priceInput.value = null;  // o puedes asignar null: priceInput.value = null;

            // Suma los precios de los servicios multiplicados por sus cantidades si no se ingresó un valor en price-input.
            serviceCheckboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const quantity = parseInt(quantityInputs[index].value, 10);
                    if (!isNaN(quantity)) {
                        totalPrice += parseFloat(servicePrices[index].textContent) * quantity;
                    }
                }
            });
        }

        totalPriceElement.style.display = 'block';
        totalPriceElement.innerHTML = `<strong>Total Price: $${totalPrice.toFixed(2)}</strong>`;
    }

</script>

@endsection








