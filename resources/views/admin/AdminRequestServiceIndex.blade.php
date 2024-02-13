@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="card shadow">    
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Service Requests</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('serviceRequests/create')}}" class="btn boton">New Service Request</a>
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
                <tr class="text-center">
                    <th scope="col"># Request</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Price</th>
                    <th scope="col">Services</th>
                    <th scope="col">User</th>
                    <th scope="col">State</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody style="background:white">
                @foreach($serviceRequests as $serviceRequest)
                <tr class="text-center">
                    <th scope="row">
                        {{ $uniqueNumbers[$loop->index] }}
                    </th>
                    <td>
                        {{$serviceRequest->comment}}
                    </td>
                    <td>
                        {{$serviceRequest->price}}
                    </td>

                    <td>
                        <p>Services:</p>
                        <ul>
                            @forelse($serviceRequest->services as $service)
                                <li>{{ optional($service)->name }} <br> - Quantity: {{ optional($service->pivot)->service_quantity }}</li>
                            @empty
                                <li>No services</li>
                            @endforelse
                        </ul>

                        <p>Packages:</p>
                        <ul>
                            @forelse($serviceRequest->packages as $package)
                                <li>{{ optional($package)->name }} <br> - Quantity: {{ optional($package->pivot)->package_quantity }}</li>
                            @empty
                                <li>No packages</li>
                            @endforelse
                        </ul>
                    </td>
                    <td>
                    {{ optional($serviceRequest->user)->name }}

                    </td>
                    <td>
                        {{ $serviceRequest->state}}
                    </td>
                    <td>
                    {{ $serviceRequest->created_at}}

                    </td>
                    <td class="text-center"> 
                    @if($serviceRequest->state !== 'Approved')
                        <form action="{{ url('/serviceRequests/'.$serviceRequest->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/serviceRequests/'.$serviceRequest->id.'/edit') }}" class=" btn boton">Approve services / <br> Edit requests</a><br><br>
                            <button type="button" class="btn boton-eliminar" data-toggle="modal" data-target="#confirmDeleteModal{{ $serviceRequest->id }}">Delete Request</button>
                            <div class="modal fade" id="confirmDeleteModal{{ $serviceRequest->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                        Are you sure you want to delete this request?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn boton" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                  </div>
                                </div>
                              </div>
                            </div>      

                    @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>
@endsection
