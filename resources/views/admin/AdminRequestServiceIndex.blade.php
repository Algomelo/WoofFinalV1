@extends('layouts.panel')

@section('content')
<style>
.button_sendrequest{
    background: #F2761D;
    color: white;
    padding: 0px 8px;
    /* margin: 0px; */
    height: 25px;
    border-radius: 12px;
}
.button_sendrequest:hover{
    background: white;
    color: #F2761D;
    padding: 0px 8px;
    /* margin: 0px; */
    height: 25px;
    border-radius: 12px;
    border-color: #F2761D;

}
</style>

<div class="card shadow">
    <div class="card-header border-0">


            <div class="row" style=" align-items: center">
                    <div class="col-md-3" style="    padding-top: 24px;">
                 
                          <h2> Request Services</h2> <br>
                    </div>
                    <div class="col-md-3 d-none">
                        <label for="filterInput" class="form-label">Filter by Name:</label>
                        <input type="text" class="form-control" id="filterNameInput" placeholder="Type to filter by name">
                    </div>
                    <div class="col-md-3  d-none" >
                        <label for="filterEmailInput" class="form-label">Filter by #Request:</label>
                        <input type="text" class="form-control" id="filterEmailInput" placeholder="Type to filter by email">

                    </div>
                    <div class="col-md-4 " >
                         <a class="button_sendrequest" href="{{ route('serviceRequests.create') }}">Create New Service Request</a>
                    </div>


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
            <tbody>
                @foreach($serviceRequests as $serviceRequest)
                <tr>
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
                            @foreach($serviceRequest->services as $service)
                            <li>{{ $service->name }} - Quantity: {{ $service->pivot->service_quantity }}</li>
                            @endforeach
                        </ul>

                        <p>Packages:</p>
                        <ul>
                            @foreach($serviceRequest->packages as $package)
                            <li>{{ $package->name }} - Quantity: {{ $package->pivot->package_quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                    {{ $serviceRequest->user->name}}

                    </td>
                    <td>
                        {{ $serviceRequest->state}}
                    </td>
                    <td>
                    {{ $serviceRequest->created_at}}

                    </td>
                    <td>
                    <a href="{{ route('admin.editServiceRequest', ['userId' => $serviceRequest->user_id, 'serviceRequestId' => $serviceRequest->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('admin.deleteServiceRequest', ['serviceRequestId' => $serviceRequest->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
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
