@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0"> Blogs</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('blogs/create')}}" class="btn btn-sm btn-primary">New Blog</a>
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
                <th scope="col">Id</th>
                <th scope="col">Titulo</th>
                <th scope="col">Autor</th>
                <th scope="col">Fecha Publicacion</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($blog as $blog)
                <tr>
                    <th scope="row">
                      {{$blog->id}}
                    </th>
                    <td>
                        {{$blog->titulo}}
                    </td>
                    <td>
                        {{$blog->autor}}
                    </td>
                    <td>
                        {{$blog->fecha_publicacion}}
                    </td>
                    <td>
                        
                         <form action="{{url('/blogs/'.$blog->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{url('/blogs/'.$blog->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
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
