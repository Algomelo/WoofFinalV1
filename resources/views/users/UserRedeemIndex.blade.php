<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@if(auth()->check() && auth()->user()->role == 'user' && !auth()->user()->show_manual)
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
                        <p>In this section, you can browse through the available services for redemption. Please remember that before redeeming a service, you need to add at least one pet to the system in the pets section. Also, once your request is scheduled, you'll find it listed in the schedules section."</p>
                            <img  src="{{asset('img/redemindex.PNG')}}"  class="img-fluid">
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
        <h2> Redeem Services</h2> <br>

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
                <th scope="col">Service Name</th>
                <th scope="col">Fecha de creacion</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Estado</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($redeemedServices as $redeemedService)
                <tr>
                    <td>{{ $redeemedService->service->name }}</td>
                    <td>{{ $redeemedService->created_at}}</td>
                    <td>{{ $redeemedService->quantity }}</td>
                    <td>{{ $redeemedService->state }}</td> 
                    <td> 
                      <a href="{{ url('userRedemption/create/'.$redeemedService->id)}}" class="btn boton">Redeem service</a><br><br>

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








