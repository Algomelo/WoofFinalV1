@extends('layouts.panel')

@section('content')

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Package</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('packages')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
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


    <form action="{{ url('/packages/', $package->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $package->name) }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" value="{{ old('description', $package->description) }}">
    </div>
    <div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" class="form-control" value="{{ $currentPackagePrice }}" id="price-input">
</div>

    
    <div class="form-group">
        <h4>Select Services:</h4>
        @foreach ($services as $service)
        <label for="service_{{ $service->id }}">
            <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}"
                class="service-checkbox" checked>
            {{ $service->name }}
        </label>
        <input type="number" name="quantities[]" placeholder="Quantity" value="{{ $service->pivot->quantity }}"
            class="quantity-input">
        <span class="service-price" style="display: none;">{{ $service->price }}</span>
        @endforeach
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Update Package</button>
    <div id="total-price"><strong>Total Price: ${{ $currentPackagePrice }}</strong></div>
    <p>Current Service Count: {{ $currentServiceCount }}</p>
</form>
                            @foreach($package->services as $service)
                            <li>{{ $service->name }} - Quantity: {{ $service->pivot->quantity }}</li>
                            @endforeach
            
           </div>     
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script>
            $(document).ready(function() {
                var currentPackagePrice = parseFloat("{{ $currentPackagePrice }}");
                var totalPrice = calculateTotalPrice();

                if (currentPackagePrice === totalPrice) {
                    $('#price-input').val('');
                } else {
                    $('#price-input').val(currentPackagePrice.toFixed());
                }

                function calculateTotalPrice() {
                    var total = currentPackagePrice;
                    $('.service-checkbox:checked').each(function() {
                        var quantity = parseInt($(this).closest('label').next('.quantity-input').val());
                        var servicePrice = parseFloat($(this).closest('label').next().next('.service-price').text());
                        total += ((quantity * servicePrice)-"{{ $currentPackagePrice }}");
                    });
                    return total;
                }
            });
        </script>
        <script>
    const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const servicePrices = document.querySelectorAll('.service-price');
    const totalPriceElement = document.getElementById('total-price');
    const priceInput = document.getElementById('price-input');

    serviceCheckboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', () => {
            updateTotalPrice();
        });

        quantityInputs[index].addEventListener('input', () => {
            updateTotalPrice();
        });
    });

    priceInput.addEventListener('input', () => {
        updateTotalPrice();
    });

    function updateTotalPrice() {
    let totalPrice = 0;

    // Verifica si price-input tiene un valor válido.
    const enteredPrice = parseFloat(priceInput.value);
    
    if (!isNaN(enteredPrice)) {
        totalPrice = enteredPrice; // Utiliza el valor ingresado en price-input.
    } else {
        // Suma los precios de los servicios multiplicados por sus cantidades si no se ingresó un valor en price-input.
        serviceCheckboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const quantity = parseInt(quantityInputs[index].value, 10);
                if (!isNaN(quantity)) {
                    totalPrice += parseFloat(servicePrices[index].textContent) * quantity;
                }
            }else{
                totalPrice = enteredPrice;
            }
        });
    }

    totalPriceElement.style.display = 'block';
    totalPriceElement.innerHTML = `<strong>Total Price: $${totalPrice.toFixed(2)}</strong>`;
}


</script>




@endsection
