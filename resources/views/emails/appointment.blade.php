<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Agendamiento de Servicio</title>
</head>
<body>
    <h2>Solicitud  de Servicio {{ $service }}   </h2>
    <p>Hola, se ha generado una nueva solicitud de servicio  con los siguientes datos:</p>
    <ul>
        <li>Nombre: {{ $data['name'] }}</li>
        <li>Direccion: {{ $data['address'] }}</li>
        <li>Raza mascota: {{ $data['dogbreed'] }}</li>
        <li>Teléfono: {{ $data['phone'] }}</li>
        <li>Correo Electrónico: {{ $data['email'] }}</li>
        <li>Mensaje: {{ $data['message'] }}</li>
    </ul>
</body>
</html>
