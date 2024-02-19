@extends('layouts.panel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                <h3 class="mb-0">Edit Request Service</h3>
                </div>
                <div class="col text-right">
                <a href="{{ url('serviceRequests')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
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
            

            <!-- Formulario de edición -->
            <form action="{{url('/serviceRequests/'.$serviceRequest->id)}}" method="POST">
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
                <select name="state" class="form-control">
                    <option value="pending" {{ $serviceRequest->state === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $serviceRequest->state === 'Approved' ? 'selected' : '' }}>Approved (In this option the user will be able to view the price of the request)</option>
                    <option value="Send" {{ $serviceRequest->state === 'Send' ? 'selected' : '' }}>Send (In this option the user can edit the service request)</option>
                </select>
                    
                </div>
                <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="date">Estimated Date(s):</label> <br>
                            <input type="text" name="date" id="date"  ><br><br>
                            <span id="dateError" class="error"></span>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="shift">Shift:</label> <br>
                            <select name="shift" id="shift">
                                <option value="Any shift" {{ $serviceRequest->shift == 'Any shift' ? 'selected' : '' }}>Any shift</option>
                                <option value="morning" {{ $serviceRequest->shift == 'morning' ? 'selected' : '' }}>Morning Shift</option>
                                <option value="afternoon" {{ $serviceRequest->shift == 'afternoon' ? 'selected' : '' }}>Afternoon Shift</option>
                            </select>
                            <span id="shiftError" class="error"></span>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="address">Address:</label> <br>
                            <input type="text" name="address" id="address"  value="{{$serviceRequest->address}}" >
                        </div>
                </div>
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
                        <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="{{ $service->pivot->service_quantity }}" id="quantityInput" class="quantity-input" readonly>
                        
                    @endforeach
                </div>
            </div>
                <div class="form-group">
                    <label for="custom_price">Enable Custom Price</label>
                    <input type="checkbox" name="custom_price" id="custom_price" onchange="toggleCustomPrice()">
                </div>
                <div id="total-price"><strong>Total Price: $<span id="totalPriceValue">{{ $serviceRequest->price  }}</span><br> </strong></div>

                <div class="form-group">
                    <label for="price">Custom Price</label>
                    <input type="number" name="price" class="form-control" value="" id="price-input" disabled>
                </div>
                <button type="submit" class="btn boton">Save Changes</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var quantityInput = document.getElementById('quantityInput');
        var quantity = 0;
        var dateInput = document.getElementById('date');
        var preselectedDates = {!! json_encode($scheduledDates) !!};
        var totalPriceElement = document.getElementById('totalPriceValue');
        var customPriceCheckbox = document.getElementById('custom_price');
        var priceInput = document.getElementById('price-input');

        var fp = flatpickr(dateInput, {
            mode: 'multiple',
            dateFormat: 'Y-m-d',
            defaultDate: preselectedDates,
            onChange: function (selectedDates, dateStr, instance) {
                quantity = selectedDates.length;
                updateQuantity(quantity);
            }
        });

        function updateQuantity(quantity) {
            quantityInput.value = quantity;
            calculateTotalPrice();
        }

        function calculateTotalPrice() {
            var price = parseFloat(priceInput.value);
            var total;
            if (isNaN(price)) {
                total = parseFloat({{ $service->price }}) * parseFloat(quantity);
            } else {
                total = price;
            }
            totalPriceElement.innerText = total.toFixed(2);
        }

        customPriceCheckbox.addEventListener('change', function () {
            priceInput.disabled = !this.checked;
            if (!this.checked) {
                priceInput.value = ''; // Limpiar el campo de precio personalizado si el checkbox no está marcado
            }
            calculateTotalPrice();
        });

        priceInput.addEventListener('input', function () {
            calculateTotalPrice();
        });
    });
</script>
@endsection