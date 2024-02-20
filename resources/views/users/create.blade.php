<?php
use Illuminate\Support\Str; 
?>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">New User</h3>
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


            <form action="{{url('/users')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control" value="{{old('phone')}}" required>
                </div>
                <div class="form-group">
                    <label for="direction">Address</label>
                    <input type="text" name="address" class="form-control" value="{{old('address')}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <small class="text-warning">The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit. Please ensure your password meets these security requirements</small>
                    <input type="password" name="password" id="password" class="form-control" value="{{ old('password', Str::random(8)) }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"> <br>
                    <button class="btn boton" type="button" id="showPasswordBtn">Show Password</button>
                </div>
                <button type="submit" class="btn boton">Create User</button>
            </form>          
           </div>     
      </div>
      <script>
          document.addEventListener("DOMContentLoaded", function() {
              var passwordInput = document.getElementById('password');
              var passwordInputC = document.getElementById('password_confirmation');
              var showPasswordBtn = document.getElementById('showPasswordBtn');            
              showPasswordBtn.addEventListener('click', function() {
                  if (passwordInput.type === "password") {
                      passwordInput.type = "text";
                      passwordInputC.type = "text";
                      showPasswordBtn.textContent = "Hide Password";
                  } else {
                      passwordInput.type = "password";
                      passwordInputC.type = "password";

                      showPasswordBtn.textContent = "Show Password";
                  }
              });
          });
      </script>

@endsection
