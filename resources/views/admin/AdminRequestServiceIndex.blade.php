@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="card shadow">    
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Request Services</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('serviceRequests/create')}}" class="btn boton">New Service Request</a>

                
            </div>
        </div>     
    </div>           
    <div class="card-body">
            @if(session('notification'))
            <div class="alert alert-success" role="alert">
                {{session('notification')}}
            </div>
            @endif
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
            <tbody style="background:white">
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
                            @forelse($serviceRequest->services as $service)
                                <li>{{ optional($service)->name }} <br> - Quantity: {{ optional($service->pivot)->service_quantity }}</li>
                            @empty
                                <li>No services</li>
                            @endforelse
                        </ul>

                        <p>Packages:</p>
                        <ul>
                            @forelse($serviceRequest->packages as $package)
                                <li>{{ optional($package)->name }} <br> - Quantity: {{ optional($package->pivot)->package_quantity }}</li>
                            @empty
                                <li>No packages</li>
                            @endforelse
                        </ul>
                    </td>
                    <td>
                    {{ optional($serviceRequest->user)->name }}

                    </td>
                    <td>
                        {{ $serviceRequest->state}}
                    </td>
                    <td>
                    {{ $serviceRequest->created_at}}

                    </td>
                    <td>
                    @if($serviceRequest->state !== 'passed')
                        <form action="{{ url('/serviceRequests/'.$serviceRequest->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/serviceRequests/'.$serviceRequest->id.'/edit') }}" class=" btn boton">See More Info / Edit Info</a>
                            <button type="submit" class="btn boton-eliminar">Eliminar</button>

                    @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>
@endsection
