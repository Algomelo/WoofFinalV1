@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Package</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('packages')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
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


            <form action="{{url('/packages/', $package->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$package->name)}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" value="{{old('description',$package->description)}}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" value="{{old('price', $package->price)}}">
                </div>
                <div class="form-group">
                    <h4>Select Services:</h4>
                     @foreach($services as $service)
                        <label for="service_{{ $service->id }}">
                             <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}">
                             @if($package->services->contains($service->id)) checked @endif>       
                             {{ $service->name }}
                        </label>
                              <input type="number" name="quantities[]" placeholder="Quantity"
                              value="{{ $package->services->contains($service->id) ? $package->services->find($service->id)->pivot->quantity : '' }}"
                              >
                     @endforeach
                    
                    
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Update Package</button>

            </form>
            
           </div>     
      </div>
 

@endsection
