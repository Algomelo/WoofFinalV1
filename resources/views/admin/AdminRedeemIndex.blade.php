<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="card shadow">
        <div class="card-body d-flex justify-content-between">
        <h2>Booking Request</h2> <br>
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
    <table class="table align-items-center table-flush text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">Creation Date</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scheduled as $scheduleds)
            <tr>
                <td>{{ $scheduleds->created_at}}</td>
                <td>{{ $scheduleds->state }}</td>
                <td>
                    User Name:<br> {{ $scheduleds->user->name }}<br>_________________________
                    <br>Service Name:<br>{{$scheduleds->service->name}}<br>_________________________
                    <br>Pets Associated:<br>
                    @foreach ($scheduleds->pets as $pet)
                    {{ $pet->name }},
                    @endforeach<br>_________________________
                    <br>Pickup Dates:<br>{{ $scheduleds->date}}
                </td>
                <td>
                <a class="btn boton" href="{{ route ('admin.EditRedem',['scheduledId' => $scheduleds->id])}}">Edit // approve </a>
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







