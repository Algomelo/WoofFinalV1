<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">




<div class="card shadow">

        <div class="card-body d-flex justify-content-between">
        <h2> Request Services</h2> <br>
           <a href="{{ route('user.sendRequestForm', ['userId' => $userId]) }}" class="btn boton ">Sent  New Request Service</a>

            @if($errors->any())
            @foreach($errors ->all() as $error)
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
                <th scope="col">State</th>
                <th scope="col">Date Created</th>

                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviceRequests as $serviceRequest)
            <tr>
                <th scope="row">{{ $uniqueNumbers[$loop->index] }}</th>
                <td>{{ $serviceRequest->comment }}</td>
                
                @if($serviceRequest->state === 'passed')
                    <td>$ {{ $serviceRequest->price }}</td>
                @else
                    <td>-</td>
                @endif

                <td >
                    <p>Services:</p>
                    <ul >
                        @foreach($serviceRequest->services as $service)
                            <li>{{ $service->name }}  <br> Quantity: {{ $service->pivot->service_quantity }}</li>
                        @endforeach
                    </ul>

                    <p>Packages:</p>
                    <ul>
                        @foreach($serviceRequest->packages as $package)
                            <li>{{ $package->name }}  <br>  Quantity: {{ $package->pivot->package_quantity }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $serviceRequest->state }}</td>
                <td>{{ $serviceRequest->created_at}}</td>

                <td>
                    @if($serviceRequest->state !== 'passed')
                    
                        <a href="{{ route('user.editServiceRequest',['userId' => $userId, 'serviceRequestId' => $serviceRequest->id]) }}" class="btn boton">Edit</a><br><br>
                    @endif
                    <form action="{{ route('user.deleteServiceRequest', ['userId' => $userId, 'serviceRequestId' => $serviceRequest->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn boton-eliminar ">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



        </div>

        <div class="container" >
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


@endsection








