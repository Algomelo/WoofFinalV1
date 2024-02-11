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
              <a href="{{ url('userPets')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
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

            <form action="{{url('/userPets')}}" method="POST">


                @csrf


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                </div>


                <div class="form-group">
                    <label for="phone">DOB - Day of birth</label>
                    <input type="tel" name="age" class="form-control" value="{{old('age')}}" required>
                </div>
                <div class="form-group">
                    <label for="direction">Breed</label>
                    <input type="text" name="breed" class="form-control" value="{{old('breed')}}">
                </div>
                <div class="form-group">
                    <label for="direction">Comment</label>
                    <input type="text" name="comment" class="form-control" value="{{old('comment')}}">
                </div>



                    
                <button type="submit" class="btn boton">Create Pet</button>

            </form>
            
           </div>     
      </div>
 

@endsection
