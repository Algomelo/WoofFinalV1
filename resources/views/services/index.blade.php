@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">



      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Services</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('services/create')}}" class="btn boton">New Service</a>
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
                <th scope="col">Price</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody >
                @foreach ($services as $service)
                <tr>
                    <th scope="row">
                      {{$service->name}}
                    </th>
                    <td>
                        {{$service->description}}
                    </td>
                    <td>
                        {{$service->price}}
                    </td>
                    <td>
                        
                         <form action="{{url('/services/'.$service->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{url('/services/'.$service->id.'/edit')}}" class="btn boton">Edit</a>
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
