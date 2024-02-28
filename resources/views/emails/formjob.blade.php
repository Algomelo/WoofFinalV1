<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    <h2>{{ $data['fullname'] }} Quiere contactar contigo para postularse como Walker</h2>
    <p>Hola, se ha generado el contacto de un candidato con los siguientes datos:</p>
    <ul>
        <ul>
            <li><strong>Full Name:</strong> {{ $data['fullname'] }}</li>
            <li><strong>Address:</strong> {{ $data['address'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
            <li><strong>Message:</strong> {{ $data['message'] }}</li>
        </ul>
    </ul>
</body>
</html>