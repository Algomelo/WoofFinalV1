@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="card shadow">
    <div class="card-header border-0">
    <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Request Services</h3>
            </div>
            <a class="boton" href="{{ route('serviceRequests.create') }}">Create New Service Request</a>
    </div>        



                   
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Please!!</strong> {{$error}}
                </div>
                @endforeach
                @endif
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col"># Request</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Price</th>
                    <th scope="col">Services</th>
                    <th scope="col">User</th>
                    <th scope="col">State</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serviceRequests as $serviceRequest)
                <tr>
                    <th scope="row">
                        {{ $uniqueNumbers[$loop->index] }}
                    </th>
                    <td>
                        {{$serviceRequest->comment}}
                    </td>
                    <td>
                        {{$serviceRequest->price}}
                    </td>

                    <td>
                        <p>Services:</p>
                        <ul>
                            @foreach($serviceRequest->services as $service)
                            <li>{{ $service->name }} <br> - Quantity: {{ $service->pivot->service_quantity }}</li>
                            @endforeach
                        </ul>

                        <p>Packages:</p>
                        <ul>
                            @foreach($serviceRequest->packages as $package)
                            <li>{{ $package->name }} <br> - Quantity: {{ $package->pivot->package_quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                    {{ $serviceRequest->user->name}}

                    </td>
                    <td>
                        {{ $serviceRequest->state}}
                    </td>
                    <td>
                    {{ $serviceRequest->created_at}}

                    </td>
                    <td>
                    @if($serviceRequest->state !== 'passed')
                        <form action="{{ route('admin.deleteServiceRequest', ['serviceRequestId' => $serviceRequest->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('admin.editServiceRequest', ['userId' => $serviceRequest->user_id, 'serviceRequestId' => $serviceRequest->id]) }}" class="btn boton">Edit</a>
                            <button type="submit" class="btn boton-eliminar">Eliminar</button>

                    @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        <div class="container-dialog" role="document">
            <div class="container-content" style="width:100%">
                <div class="container">
                    <div class="container d-block" style="justify-content: space-evenly;">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>
@endsection
