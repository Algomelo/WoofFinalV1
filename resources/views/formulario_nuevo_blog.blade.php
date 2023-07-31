<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #015351;
            color: #FFF;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #F2761D;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FEB336;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #FFF;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #F2761D;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #F2761D;
            color: #FFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #FEB336;
            transition: background-color 0.3s;
        }

        /* Estilo adicional para textarea */
        textarea {
            resize: vertical;
        }

        /* Estilos responsive */
        @media (max-width: 600px) {
            form {
                padding: 10px;
            }

            input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <h2>Nuevo Blog</h2>
    <form action="{{ route('blog.store') }}" method="POST">
        @csrf
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>
        
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" rows="6" required></textarea>
        
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required>
        
        <input type="submit" value="Publicar Blog">
    </form>
</body>
</html>
