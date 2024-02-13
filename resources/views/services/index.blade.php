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
              <tr class="text-center">
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody >
                @foreach ($services as $service)
                <tr class="text-center"> 
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
                            <a href="{{url('/services/'.$service->id.'/edit')}}" class="btn boton">Edit</a><br><br>
                            
                            <button type="button" class="btn boton-eliminar" data-toggle="modal" data-target="#confirmDeleteModal{{ $service->id }}">Delete</button>
                            <div class="modal fade" id="confirmDeleteModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                        Are you sure you want to delete this service?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                  </div>
                                </div>
                              </div>
                            </div>       
                         </form>
                      </td>
                  </tr>  
                @endforeach
            </tbody>
          </table>
                                        <!-- Modal para confirmar la eliminación -->
     

        </div>
      </div>
 

@endsection
