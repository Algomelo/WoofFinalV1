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
              <h3 class="mb-0">Edit User</h3>
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


            <form action="{{url('/users/'.$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$user->name)}}">
                </div>
                <div class="form-group">
                    <label for="cedula">Identification Card</label>
                    <input type="text" name="cedula" class="form-control" value="{{old('cedula',$user->cedula)}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control" value="{{old('phone',$user->phone)}}">
                </div>
                <div class="form-group">
                    <label for="direction">Address</label>
                    <input type="text" name="address" class="form-control" value="{{old('address',$user->address)}}">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" name="password" class="form-control" >
                  <small class="text-warning">Solo llene el campo si desea cambiar la contraseña</small>
              </div>
                <button type="submit" class="btn boton">Save changes</button>

            </form>
            
           </div>     
      </div>
 

@endsection
