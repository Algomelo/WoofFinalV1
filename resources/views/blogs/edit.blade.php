@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Blogs</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('blogs')}}" class="btn btn-sm btn-success"><i class="fas fa-angle-left"></i>Return</a>
            </div>
          </div>
        </div>
           <div class="card-body">

            @if($errors->any())
            @foreach($errors ->all() as $error)
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please!!</strong> {{$error}}
            </div>
            @endforeach
            @endif


            <form action="{{url('/blogs/'.$blog->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo">titulo</label>
                    <input type="text" name="titulo" class="form-control" value="{{old('titulo')}}" required>
                </div>
                <div class="form-group">
                    <label for="contenido">contenido</label>
                    <input type="text" name="contenido" class="form-control" value="{{old('contenido')}}">
                </div>
 
                <div class="form-group">
                    <label for="autor">autor</label>
                    <input type="text" name="autor" class="form-control" value="{{old('autor')}}" required>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Save Service</button>

            </form>
            
           </div>     
      </div>
 

@endsection
