@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="card shadow">
    <div class="card-header border-0">
    <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">My Pets</h3>
            </div>
            <a href="{{ url('userPets/create')}}" class="btn boton">New pet</a>


    </div>        
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Please!!</strong> {{$error}}
                </div>
                @endforeach
                @endif
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Breed</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                <tr>
                    <th scope="row">
                      {{$pet->name}}
                    </th>
                    <td>
                        {{$pet->age}}
                    </td>
                    <td>
                        {{$pet->breed}}
                    </td>

                    <td>
                        {{$pet->comment}}
                    </td>
                    <td>
                        {{ $pet->created_at}}
                    </td>
                    <td>
                    <form action="{{url('/userPets/'.$pet->id)}}" method="POST">

                            @csrf
                            @method('DELETE')
                            <a href="{{url('/userPets/'.$pet->id.'/edit')}}" class=" btn boton">Edit</a>

                            <button type="button" class="btn boton-eliminar" data-toggle="modal" data-target="#confirmDeleteModal{{ $pet->id }}"> Eliminar</button>
                            <div class="modal fade" id="confirmDeleteModal{{ $pet->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                        Are you sure you want to delete this pet?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn boton" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn boton-eliminar">Delete</button>
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
    </div>

    <div class="container">
        <div class="container-dialog" role="document">
            <div class="container-content" style="width:100%">
                <div class="container">
                    <div class="container d-block" style="justify-content: space-evenly;">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>
@endsection
