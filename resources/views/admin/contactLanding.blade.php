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
            <a href="{{ route('export') }}" class="btn btn-success">Exportar a Excel</a>

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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Service</th>
                    <th scope="col">Address</th>
                    <th scope="col">Dog Name</th>
                    <th scope="col">Breed</th>
                    <th scope="col">Age</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody style="background:white">
                @foreach($sistemsEmails as $email)
                <tr class="text-center">
                    <td>{{ $email->name }}</td>
                    <td>{{ $email->email }}</td>
                    <td>{{ $email->phone }}</td>
                    <td>{{ $email->comment }}</td>
                    <td>{{ $email->service }}</td>
                    <td>{{ $email->address }}</td>
                    <td>{{ $email->dogname }}</td>
                    <td>{{ $email->breed }}</td>
                    <td>{{ $email->age }}</td>
                    <td>{{ $email->created_at}}
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


@endsection
