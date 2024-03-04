@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Service</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('services')}}" class="btn  boton"><i class="fas fa-angle-left"></i>Return</a>
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


            <form action="{{url('/services/'.$service->id)}}" method="POST">
                @csrf
                @method('PUT')
                @if($service->name == "Dog Walking"  || $service->name == "Doggy Day Care")                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name', $service->name)}}" required readonly>
                </div>
                @else
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name', $service->name)}}" required>
                </div>
                @endif
                <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" name="description" class="form-control" value="{{old('description', $service->description)}}">
                </div>
                <div class="form-group">
                    <label for="name">Price</label>
                    <input type="number" name="price" class="form-control" value="{{old('price',$service->price)}}" required>
                </div>
                <button type="submit" class="btn boton">Save Service</button>

            </form>
            
           </div>     
      </div>
 

@endsection
