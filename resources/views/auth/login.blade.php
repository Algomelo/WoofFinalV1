@extends('layouts.form')


@section('content')


<div class="logo">

<img src="{{ asset('/imagess/Negativelogo.png') }}" alt="Logo de tu empresa">

</div>

<div class="card">

    <form role="form" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Resto del contenido del formulario... -->

        <div class="form-group mb-3">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}"
                    required autocomplete="email" autofocus>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Password" type="password" name="password" required
                    autocomplete="current-password">
            </div>
        </div>
        <div class="custom-control custom-control-alternative custom-checkbox">
            <input name="remember" class="custom-control-input" id="remember" type="checkbox"
                {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">
                <span class="text-muted">Remember me</span>
            </label>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </form>

    <div class="row mt-3">
        <div class="col-6">
            <a href="{{ route('password.request') }}" class="text-light"><small>Forgot password?</small></a>
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('register') }}" class="text-light"><small>Create neeew account</small></a>
        </div>
    </div>
</div>

@endsection
