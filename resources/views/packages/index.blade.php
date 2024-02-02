@extends('layouts.panel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Packages</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('packages/create')}}" class="btn boton">New Package</a>
            </div>
          </div>
        </div>
         <div class="card-body">
            @if(session('notification'))
            <div class="alert alert-success" role="alert">
                {{session('notification')}}
            </div>

            @endif

         </div>
         <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">totalprice</th>
                <th scope="col">Services</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                <tr>
                    <th scope="row">
                      {{$package->name}}
                    </th>
                    <td>
                        {{$package->description}}
                    </td>
                    <td>
                        {{$package->price}}
                    </td>
                    <td>
                        <ul>
                            @foreach($package->services as $service)
                            <li>{{ $service->name }} </li>
                            Unit Price: {{$service->price}}  <br> 
                            Quantity: {{ $service->pivot->quantity }}<br><br>
        
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        
                         <form action="{{url('/packages/'.$package->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{url('/packages/'.$package->id.'/edit')}}" class="btn boton">Edit</a> 
                            <button type="submit" class="btn boton-eliminar">Delete</button> 

                         </form>
                   
                      </td>
                    
                  </tr>  
                @endforeach
              
              
            </tbody>
          </table>
        </div>
      </div>
 

@endsection
