@extends('layouts.form')

@section('title','Sign Up')
<head>
<script src="https://kit.fontawesome.com/fc42b657b4.js" crossorigin="anonymous"></script>
<style>
  .boton {
    background-image: url(/img/banner_huellas.png) !important;
    color: white;
    padding: 3px 10px;
    /* margin: 0px; */
    border-radius: 12px;}
    .boton:hover{
    background-image:url(/img/banner_huellas_azul.png) !important;
    color: white;
    padding: 3px 10px;
    /* margin: 0px; */
    border-radius: 12px;
}
</style>  

</head>  

@section('content')
<div class="container mt--8 pb-5">
    <!-- Table -->
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card bg-secondary shadow border-0">
         <!-- Registro con google 
            <div class="card-header bg-transparent pb-5">
            <div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>
            <div class="text-center">
              <a href="#" class="btn btn-neutral btn-icon mr-4">
                <span class="btn-inner--icon"><img src="{{asset('img/icons/common/github.svg')}}"></span>
                <span class="btn-inner--text">Github</span>
              </a>
              <a href="#" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon"><img src="{{asset('img/icons/common/google.svg')}}"></span>
                <span class="btn-inner--text">Google</span>
              </a>
            </div>
          </div> 
         -->
          <div class="card-body px-lg-5 py-lg-5">
            @if ($errors->any())

            <div class="text-center text-muted mb-2">
                <h4>the following error was found.</h4>
            </div>

            <div class="alert text-center alert-danger mb-4" role="alert">
                {{ $errors->first() }}<br><br>
            </div>

            @else

            <div class="text-center text-muted mb-4">
                <small>
                    Enter your data.</small><br><br>
            </div>
            @endif
            <form  method="POST" action="{{ route('register') }}">
                @csrf
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                  </div>
                  <input class="form-control" placeholder="Name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                  </div>
                  <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-house"></i></span>
                  </div>
                  <input class="form-control" placeholder="Address" type="text" name="address" value="{{ old('address') }}" required autocomplete="address">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                  </div>
                  <input class="form-control" placeholder="Phone" type="number" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-shield-dog"></i></span>
                  </div>
                  <input class="form-control" placeholder="petname" type="petname" name="petname" value="{{ old('petname') }}"  autocomplete="petname">
                </div>
              </div>
              <div class="text-center">
              <small class="text-warning">The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.</small><br><br>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend ">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Password" type="password" id="password" name="password" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Repeat Password" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">

                </div>
              </div>

              <div class="text-center">

              <button class="btn boton" type="button" id="showPasswordBtn">Show Password</button>
              </div>
                <div class="col-12">

                  <div class="custom-control custom-control-alternative custom-checkbox">

                    <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                    <label class="custom-control-label" for="customCheckRegister">
                      <span class="text-muted d-none">I agree with the <a href="#!">Privacy Policy</a></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn boton mt-4">Create account</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
