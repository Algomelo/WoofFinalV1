<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">New Pet</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('users')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
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
            <form action="{{url('/userPets/'.$pet->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $pet->name }}" required>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">DOB - Day of birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ $pet->date_of_birth }}" required>
                </div>
                <div class="form-group">
                    <label for="direction">Breed</label>
                    <input type="text" name="breed" class="form-control" value="{{ $pet->breed }}">
                </div>

                <button type="submit" class="btn boton">Edit Pet</button>
            </form>
           </div>     
      </div>
@endsection
