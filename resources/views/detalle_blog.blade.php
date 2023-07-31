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
</body>
</html>
