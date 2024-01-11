<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">




<div class="card shadow">

        <div class="card-body d-flex justify-content-between">
        <h2> Scheduled Services</h2> <br>

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
                    <td>{{ $redeemedService->service->created_at}}</td>
                    <td>{{ $redeemedService->quantity }}</td>
                    <td>{{ $redeemedService->state }}</td> 

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








