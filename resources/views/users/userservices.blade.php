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
<div class="modal fade" id="assignPackageModal" tabindex="-1" role="dialog" aria-labelledby="assignPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h1>Assign Packages{{ $user->name }}</h1>


            </div>
            <div class="modal-body">
    
                            @if (count($allPackages) > 0)
                            
                                <form action="{{ route('users.assignPackages', $user->id) }}" method="POST">
                                    @csrf
                                    <h3>Paquetes Asignados:</h3>


                                    @foreach ($allPackages as $package)
                                        <label>
                                            <input type="checkbox" name="selected_packages[]" value="{{ $package->id }}"
                                                {{ $userPackages->contains($package->id) ? 'checked' : '' }}>
                                            {{ $package->name }}
                                            {{ $package->price }}

                                        </label><br>
                                        
                                    @endforeach

                                    <button type="submit" class="btn btn-sm btn-primary">Asignar Paquetes</button>
                                </form>
                            @else
                                <p>No hay paquetes disponibles.</p>
                            @endif

                       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
                    <input type="text" value="Hola, necesito tres paquetes premiun y adicionarle dos" style="width:100%;">
                </div>
                <br>
                <div class="container d-flex" style="justify-content: space-evenly;">
                            @if (count($allPackages) > 0)
                            <br>
                                <form action="{{ route('users.assignRequest', $user->id), $serviceRequestId-> }}" method="POST">
                                    @csrf
                                    <h3>Included Packages</h3>


                                    @foreach ($allPackages as $package)
                                        <label>
                                            <input type="checkbox" name="selected_packages[]" value="{{ $package->id }}"
                                                {{ $userPackages->contains($package->id) ? 'checked' : '' }}>
                                            {{ $package->name }}
                                            {{ $package->price }}
                                            <input type="number" name="quantities[{{ $package->id }}]" placeholder="Quantity" value="" class="quantity-input">
                                            <span class="service-price" style="display:none;">{{ $package->price }}</span>
                                        </label><br>
                                    @endforeach

                                    <button type="submit" class="btn btn-sm btn-primary">Asignar Paquetes</button>
                                </form>
                            @else
                                <p>No hay paquetes disponibles.</p>
                            @endif
                            @if (count($allPackages) > 0)
                            <br>
                                <form action="{{ route('users.assignRequest', $user->id) }}" method="POST">
                                    @csrf
                                    <h3>Included Services</h3>


                                    @foreach ($allPackages as $package)
                                        <label>
                                            <input type="checkbox" name="selected_packages[]" value="{{ $package->id }}"
                                                {{ $userPackages->contains($package->id) ? 'checked' : '' }}>
                                            {{ $package->name }}
                                            {{ $package->price }}

                                        </label><br>
                                    @endforeach

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








