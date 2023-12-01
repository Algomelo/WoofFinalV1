@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Users</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('users/create')}}" class="btn btn-sm btn-primary">New User</a>
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
                <th scope="col">Identication Card</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
    <tr>
        <th scope="row">
            {{$user->name}}
        </th>
        <td>
            {{$user->cedula}}
        </td>
        <td>
            {{$user->email}}
        </td>
        <td>
            {{$user->phone}}
        </td>
        <td>
            {{$user->address}}
        </td>
        <td>
            <form action="{{url('/users/'.$user->id)}}" >
                @csrf
                @method('DELETE')
                <a href="{{url('/users/'.$user->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                @if ($user->packages->isNotEmpty())
                    @php
                        $firstPackage = $user->packages->first();
                    @endphp

                    <a href="{{ route('users.assignPackagesForm', ['userId' => $user->id]) }}" class="btn btn-sm btn-primary">Management Services</a>
                @endif
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

              
              
            </tbody>
          </table>
        </div>
        <div class="card-body">
              {{$users->links() }}
        </div>
      </div>
 

@endsection
