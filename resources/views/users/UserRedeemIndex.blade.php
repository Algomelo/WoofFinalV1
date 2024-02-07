<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@if(auth()->user()->show_manual)
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
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Instrucciones para solicitar un servicio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>This section showcases all services previously approved by the administrator and now available for redemption. Each redeemed service will incur a discount. It's essential to create at least one pet in the pets section before redeeming a service to associate it properly.</p>
                        <img src="./images/servicerequestindex.png" alt="Descripción de la imagen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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
                      <a href="{{ url('userRedemption/create/'.$redeemedService->id)}}" class="btn boton">Redimir</a><br><br>

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








