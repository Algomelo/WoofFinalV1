<!DOCTYPE html>
<html>
<head>
    <title>Nuevo usuario registrado</title>
</head>
<body>
    <p>Hola, un nuevo usuario se ha registrado en sus sistema</p>
    <ul>
        <ul>
            <li><strong>Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
            <li><strong>Address:</strong> {{ $data['address'] }}</li>
            <li><strong>Dog Name:</strong> {{ $data['petname'] }}</li>
        </ul>
    </ul>
</body>
</html>
