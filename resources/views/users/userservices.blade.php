<?php
use Illuminate\Support\Str; 
?>

@extends('layouts.panel')

@section('content')


<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Management Services</h3>
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


                <div class="form-group">
                    <label for="name">User:</label>
                  {{old('name',$user->name)}}
                </div>

                <div class="form-group">
                    <label for="Phone">Phone:</label>
                    {{old('phone',$user->phone)}}
                </div>
                
                <div class="form-group">
                    <label for="email">Address:</label>
                    {{old('address',$user->address)}}
                </div>
                <div href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignPackageModal">Section packages</div>
                <div href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignServiceModal">Section Services</div>
                <div href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignServiceModal">Service scheduling</div>
                <div href="/request" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignRequestModal">Service Request</div>


      </div>




<!-- Modal Section packages -->

<div class="modal fade" id="assignRequestModal" tabindex="-1" role="dialog" aria-labelledby="assignRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:100vh">
            <div class="modal-header">
                <div class="container">
                        <h1>Service Request #
                        <h2>{{ $user->name }}</h2>
                </div>

            </div>
            <div class="modal-body">
                <div class="container">
                    <input type="text" value="Hola, necesito tres paquetes premiun y adicionarle dos" style="width:100%; height 15vh; border-radius:3px; padding:30px">
                </div>
                <br>
                <div class="container d-flex" style="justify-content: space-evenly;">
                            @if (count($allPackages) > 0)
                            <br>
                                 <div class="form-group">

                                <form action="{{ route('admin.assignRequestForm', $user->id) }}" method="POST">
                                    @csrf
                                    <h3>Included Packages</h3>


                                    @foreach ($allPackages as $package)
                                    <label for="package_{{ $package->id }}">
                                        <input type="checkbox" name="packages[]" value="{{ $package->id }}" id="package_{{ $package->id }}"
                                            {{ $userPackages->contains($package->id) ? 'checked' : '' }}>
                                        {{ $package->name }}
                                        {{ $package->price }}
                                        <input type="number" name="quantities[{{ $package->id }}]" placeholder="Quantity" value="" class="quantity-input">
                                        <span class="service-price" style="display:none;">{{ $package->price }}</span>
                                    </label><br>

                                    @endforeach
                                </div>

                                <div class="form-group">

                                    <h3>Included Services </h3>


                                    @foreach ($allServices as $service)
                                        <label>
                                            <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}"
                                                {{ $userServices->contains($service->id) ? 'checked' : '' }}>
                                            {{ $service->name }}
                                            {{ $service->price }}
                                            <input type="number" name="quantities[{{ $service->id }}]" placeholder="Quantity" value="" class="quantity-input">
                                        </label><br>
                                    @endforeach

                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Asignar Paquetes</button>

                                </form>
                            @else
                                <p>No hay paquetes disponibles.</p>
                            @endif
   

               
                </div>
       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection








