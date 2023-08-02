@extends('layouts.panel')

@section('content')


      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">New Blog</h3>
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


            <form action="{{ url('/blogs') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
    </div>
    <div class="form-group">
        <label for="contenido">Contenido</label>
        <input type="text" name="contenido" class="form-control" value="{{ old('contenido') }}">
    </div>
    <div class="form-group">
        <label for="autor">Autor</label>
        <input type="text" name="autor" class="form-control" value="{{ old('autor') }}" required>
    </div>
    <div class="form-group">
        <label for="image_path">Imagen</label>
        <input type="file" name="image_path" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Crear Blog</button>
</form>


  
            
           </div>     
      </div>
 

@endsection
