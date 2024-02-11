<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">





@if(!auth()->user()->show_manual)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Aquí puedes mostrar una ventana modal o ejecutar un script -->
        <script>
            // Ejemplo de script que muestra una ventana modal
            $(document).ready(function() {
                $('#myModal').modal('show'); // Asegúrate de que el ID del modal coincida con el que estás utilizando
            });
        </script>

        <!-- Agrega aquí el código HTML para la ventana modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding-bottom:0rem;">
                        <h4 class="modal-title" id="exampleModalLabel">Guidelines for Service Requests</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenido para pantallas grandes -->
                        <div class="d-none d-lg-block">
                            <p>"In this section, you can monitor the status of your requests, make edits, and initiate new requests. Please note that once a request is approved, the corresponding services will be accessible under the 'My Services' section."</p>
                            <img  src="{{asset('img/requestindex.PNG')}}"  class="img-fluid">
                        </div>
                        <!-- Contenido para pantallas pequeñas -->
                        <div class="d-lg-none">
                            <p>"Contenido alternativo para pantallas pequeñas."</p>
                            <img  src="{{asset('img/requestindex.PNG')}}"  class="img-fluid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form id="manualPreferenceForm" action="{{ url('manualPreference') }}" method="post">
                            @method('PUT') <!-- Agrega el método PUT -->
                            @csrf
                            <div class="form-check">
                                <input type="hidden" name="noMostrarManual" value="0"> <!-- Valor predeterminado, se enviará si el checkbox no está marcado -->
                                <input class="form-check-input" type="checkbox" id="noMostrarManual" name="noMostrarManual" value="1" onchange="updateCheckboxValue(this)">
                                    <label class="form-check-label" for="noMostrarManual">
                                        Hide this message in the future
                                    </label>
                                </div>

                        </form>
                        <button type="button" class="btn boton" data-dismiss="modal" onclick="submitForm()">Close</button> <!-- Cambiar a tipo "button" -->

                    </div>
                </div>
            </div>
        </div>
    @endif

<div class="card shadow">

        <div class="card-body d-flex justify-content-between">
        <h2> Request Services</h2> <br>
         <a href="{{ url('userServiceRequest/create')}}" class="btn boton">New Request</a>


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
                
                @if($serviceRequest->state === 'Approved')
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

                <td class="text-center">
                    @if($serviceRequest->state !== 'Approved')
                    
                    <a href="{{url('/userServiceRequest/'.$serviceRequest->id.'/edit')}}" class=" btn boton">Edit</a>

                    <form action="{{url('/userServiceRequest/'.$serviceRequest->id)}}"  method="POST" onsubmit="return confirm('¿Estás seguro?')">
                        @csrf
                        @method('DELETE')
                        <br>
                        <button type="submit" class="btn boton-eliminar ">Delete</button>
                    </form>
                    @endif

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
<script type="text/javascript" src="js/prefferGuide.js" ></script>


@endsection








