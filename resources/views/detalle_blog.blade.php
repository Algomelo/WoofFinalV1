<!DOCTYPE html>
<html>
<head>
    <title>{{ $blog->titulo }}</title>
</head>
<body>
    <h2>{{ $blog->titulo }}</h2>
    <p>Autor: {{ $blog->autor }}</p>
    <p>Fecha de publicación: {{ $blog->fecha_publicacion }}</p>
    <div>
        {!! $blog->contenido !!}
    </div>
<!-- detalle_blog.blade.php -->

@if ($blog->image_path)
    <img src="{{ asset('storage/' . $blog->image_path) }}" alt="Blog Image">
@else
    <p>No hay imagen disponible</p>
@endif






</body>
</html>
