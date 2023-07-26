@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">New User</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('users')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
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
                    <label for="identification">Identification Card</label>
                    <input type="text" name="identification" class="form-control" value="{{old('identification')}}">
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
                <button type="submit" class="btn btn-sm btn-primary">Create User</button>

            </form>
            
           </div>     
      </div>
 

@endsection
