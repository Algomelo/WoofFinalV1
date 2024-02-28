@extends('layouts.panel')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css?v=1') }}">


<div class="card shadow">    
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Emails received</h3>
            </div>
            <div class="col text-right ">
                <a href="{{ url('serviceRequests/create')}}" class="d-none btn boton">New Service Request</a>
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
        <div class="row">
            <div id="Calendario1"></div>
        </div>
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr class="text-center">
                    <th scope="col">Form Name</th>
                    <th scope="col">Option</th>

                </tr>
            </thead>
            <tbody style="background:white">
                <tr class="text-center">
                    <th scope="row">
                        Landing Page
                    </th>
                    <td>
                    <a  class="btn boton"href="{{ route('indexlanding') }}">View Contact Landing</a>
                     </td>     
                </tr>   
                <tr class="text-center">
                    <th scope="row">
                        Contact
                    </th>
                    <td>
                    <a  class="btn boton"href="{{ route('indexcontact') }}">View Contact Users</a>
                     </td>     
                </tr>                                
                <tr class="text-center">
                    <th scope="row">
                        Contact Job
                    </th>
                    <td>
                    <a  class="btn boton"href="{{ route('indexcontactjob') }}">View Contact Job</a>
                     </td>     
                </tr>   
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


@endsection
