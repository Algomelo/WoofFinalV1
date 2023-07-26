@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Walkers</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('walkers/create')}}" class="btn btn-sm btn-primary">New Walker</a>
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
                @foreach ($walkers as $walker)
                <tr>
                    <th scope="row">
                      {{$walker->name}}
                    </th>
                    <td>
                        {{$walker->identification}}
                    </td>
                    <td>
                        {{$walker->email}}
                    </td>
                    <td>
                        {{$walker->phone}}
                    </td>
                    <td>
                        {{$walker->address}}
                    </td>
                    <td>
                        
                         <form action="{{url('/walkers/'.$walker->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{url('/walkers/'.$walker->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>

                         </form>
                   
                      </td>
                    
                  </tr>  
                @endforeach
              
              
            </tbody>
          </table>
        </div>
      </div>
 

@endsection
