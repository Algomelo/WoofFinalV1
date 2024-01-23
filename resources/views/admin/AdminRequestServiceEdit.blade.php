@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-body">
            <h1>Edit Request Service</h1>

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Please!!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            

            <!-- Formulario de edición -->
            <form method="POST" action="{{ route('admin.updateServiceRequest', [ 'serviceRequestId' => $serviceRequest->id]) }}">
                @csrf
                @method('PUT')

                <!-- Campos del formulario -->
               

                <div class="form-group">
                    <label for="unique_number">Unique Number:</label>
                    {{ $serviceRequest->unique_number }}
                </div>
                <div class="form-group">
                    <label for="name">User:</label>
                    {{ $serviceRequest->user->name}}
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" id="comment" name="comment">{{ $serviceRequest->comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select name="state" class="form-control" placeholder= >
                        <option value="{{ $serviceRequest->state }}"> {{ $serviceRequest->state }} </option>
                        <option value="pending">Pending</option>
                        <option value="passed">Passed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    
                </div>

            <!-- Editar otros campos de la solicitud de servicio como comentario, estado, precio, etc. -->

            <!-- Added Services -->



            <div class="form-group">
    <h4>Added Services:</h4>
    <div class="container d-block">
        @foreach($serviceRequest->services as $service)
            <label for="service_{{ $service->id }}">
                <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" class="service-checkbox" checked>
                Service Name: {{ $service->name }}
            </label>
            <label for="service_{{ $service->id }}">
                Service Price: $ {{ $service->price }} (per Unit)
            </label>
            <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="{{ $service->pivot->service_quantity }}" class="quantity-input">
            <span class="service-price" style="display:none;">{{ $service->price }}</span>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h4>Available Services:</h4>
    <div class="container d-block">
        @foreach($allServices as $availableService)
            @if (!$serviceRequest->services->contains($availableService->id))
                <label for="service_{{ $availableService->id }}">
                    <input type="checkbox" name="services[]" value="{{ $availableService->id }}"  id="service_{{ $availableService->id }}" class="service-checkbox">
                    Service Name: {{ $availableService->name }}
                </label>
                <label for="service_{{ $availableService->id }}">
                    Service Price: $ {{ $availableService->price }} (per Unit)
                </label>
                <input type="number" name="service_quantity[{{ $availableService->id }}]" value="" class="quantity-input"><br>
                <span class="service-price" style="display:none;">{{ $availableService->price }}</span>
            @endif
        @endforeach
    </div>
</div>

        


                <!-- Added s -->
        <div class="form-group">
            <hr>Added packages s: <br>
            <div class="container d-block">
            @foreach($serviceRequest->packages as $package)
                    <label for="package_{{ $package->id }}">
                        <input type="checkbox" name="packages[]" value="{{ $package->id }}" id="package_{{ $package->id }}" class="service-checkbox" checked>
                        Name: {{ $package->name }}  //  Price: $ {{ $package->price }} (xUnit)
                    </label>
                    <input type="number" name="package_quantity[{{ $package->id }}]" value="{{ $package->pivot->package_quantity }}" class="quantity-input d-none ">

                    <span class="service-price" style="display:none;">{{ $package->price }}</span>
                @endforeach
            </div>
        </div>


                                <!-- Available s -->
                <div class="form-group">
                <hr>Available s: <br>
                <div class="container d-block" >
                    @foreach($allPackages as $availablePackage)
                        @if (!$serviceRequest->packages->contains($availablePackage->id))
                            <label for="package_{{ $availablePackage->id }}">
                                <input type="checkbox" name="packages[{{ $availablePackage->id }}]" id="package_{{ $availablePackage->id }}" class="service-checkbox" value="{{ $availablePackage->id }}">
                                Name: {{ $availablePackage->name }} // Package Price: $ {{ $availablePackage->price }} (xUnit)                            
                            </label>
                            <input type="number" name="package_quantity[{{ $availablePackage->id }}]" value="package_quantity[{{ $availablePackage->id }}]" class="quantity-input d-none"> <br>

                            <span class="service-price" style="display:none;">{{ $availablePackage->price }}</span>
                        @endif
                    @endforeach


                </div>
                </div>

                <div class="form-group">
                    <label for="custom_price">Enable Custom Price</label>
                    <input type="checkbox" name="custom_price" id="custom_price" onchange="toggleCustomPrice()">
                </div>
                <div id="total-price"><strong>Total Price: ${{$serviceRequest->price}} <br> </strong></div>



                <div class="form-group">
                    <label for="price">Custom Price</label>
                    <input type="number" name="price" class="form-control" value="" id="price-input" disabled>
                </div>

                <!-- Otros campos y controles según tus necesidades -->

                <!-- Botón de envío del formulario -->
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
toggleCustomPrice()
showSection("includeServicesSection");

function showSection(sectionId) {
    // Oculta todas las secciones
    document.getElementById('includesSection').style.display = 'none';
    document.getElementById('includeServicesSection').style.display = 'none';

    // Muestra la sección correspondiente al ID recibido como parámetro
    document.getElementById(sectionId).style.display = 'block';

    // Declara e inicializa las variables antes de acceder a sus propiedades
    var textoPaquete = document.getElementsByClassName('texto_paquete')[0];
    var textoServicio = document.getElementsByClassName('texto_servicio')[0];

    // Cambia el color del texto y del fondo para reflejar la sección activa
    if (sectionId == "includesSection") {
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