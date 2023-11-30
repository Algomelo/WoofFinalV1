@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">New Package</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('packages')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Please!!</strong> {{ $error }}
        </div>
        @endforeach
        @endif
        @if(session('status'))

        @endif
        <form action="{{ url('/packages') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
            </div>
            <div class="form-group">
                <label for="custom_price">Enable Custom Price</label>
                <input type="checkbox" name="custom_price" id="custom_price" onchange="toggleCustomPrice()">
            </div>



            <div class="form-group">
                <label for="price">Custom Price</label>
                <input type="number" name="price" class="form-control" value="" id="price-input" disabled>
            </div>


            <div class="form-group">
                <h4>Select Services:</h4>
                @foreach($services as $service)
                    <label for="service_{{ $service->id }}">
                        <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" class="service-checkbox">
                        {{ $service->name }}
                    </label>
                    <input type="number" name="quantities[{{ $service->id }}]" placeholder="Quantity" value="" class="quantity-input">
                    <span class="service-price" style="display:none;">{{ $service->price }}</span>
                @endforeach

            </div>
            <button type="submit" class="btn btn-sm btn-primary">Create Package</button>
            <div id="total-price"><strong>Total Price: $0</strong></div>
        </form>

    </div>
</div>

<script>


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