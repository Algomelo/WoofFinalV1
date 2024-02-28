<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    <h2>{{ $data['name'] }} Quiere Contactar Contigo</h2>
    <p>Hola, se ha generado un nuevo contacto con los siguientes datos:</p>
    <ul>
        <ul>
            <li><strong>Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
            <li><strong>Message:</strong> {{ $data['message'] }}</li>
        </ul>
    </ul>
</body>
</html>