<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    
    <p>Hola, se ha generado una nueva solicitud de servicio  con los siguientes datos:</p>
    <ul>
        <ul>
            <li><strong>Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
            <li><strong>Interested Service:</strong> {{ $data['service'] }}</li>
            <li><strong>Address:</strong> {{ $data['address'] }}</li>
            <li><strong>Dog Age:</strong> {{ $data['dogage'] }}</li>
            <li><strong>Dog Name:</strong> {{ $data['namedog'] }}</li>
            <li><strong>Breed of Dog:</strong> {{ $data['breeddog'] }}</li>
            <li><strong>Message:</strong> {{ $data['message'] }}</li>
        </ul>
    </ul>
</body>
</html>