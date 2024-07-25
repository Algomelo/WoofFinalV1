<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OhMyWoof - README</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        pre {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            overflow-x: auto;
        }
        code {
            background: #f9f9f9;
            padding: 2px 4px;
            border-radius: 4px;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>OhMyWoof</h1>
        <p>OhMyWoof es un sistema web desarrollado en Laravel 10 que ofrece una solución completa para la gestión de servicios de agendamiento, con autenticación de usuarios, roles, integración de calendario, subida de fotos, y más.</p>
        
        <h2>Características</h2>
        <ul>
            <li><strong>Autenticación de Usuarios:</strong> Registro y inicio de sesión seguro para los usuarios.</li>
            <li><strong>Roles y Permisos:</strong> Diferentes niveles de acceso según el rol del usuario (administrador, usuario estándar).</li>
            <li><strong>Agendamiento de Servicios:</strong> Integración con el calendario para gestionar y programar servicios.</li>
            <li><strong>Subida de Fotos:</strong> Los usuarios pueden subir fotos a sus perfiles.</li>
            <li><strong>Administración de Servicios y Paquetes:</strong> Los administradores pueden crear y gestionar servicios y paquetes.</li>
            <li><strong>Aprobación de Solicitudes:</strong> Los administradores pueden aprobar servicios y solicitudes de agendamiento.</li>
            <li><strong>Gestión de Formularios:</strong> Los formularios enviados a través de la web son recibidos y gestionados dentro del sistema.</li>
        </ul>
        
        <h2>Instalación</h2>
        <p>Sigue estos pasos para instalar el proyecto localmente.</p>
        <ol>
            <li>Clona el repositorio:
                <pre><code>git clone https://github.com/tuusuario/ohmywoof.git</code></pre>
            </li>
            <li>Navega al directorio del proyecto:
                <pre><code>cd ohmywoof</code></pre>
            </li>
            <li>Instala las dependencias de Composer:
                <pre><code>composer install</code></pre>
            </li>
            <li>Copia el archivo <code>.env.example</code> a <code>.env</code> y configura tus variables de entorno:
                <pre><code>cp .env.example .env</code></pre>
            </li>
            <li>Genera la clave de la aplicación:
                <pre><code>php artisan key:generate</code></pre>
            </li>
            <li>Configura la base de datos en tu archivo <code>.env</code> y luego ejecuta las migraciones:
                <pre><code>php artisan migrate</code></pre>
            </li>
            <li>Inicia el servidor local:
                <pre><code>php artisan serve</code></pre>
                <p>Ahora puedes acceder a la aplicación en <a href="http://localhost:8000" target="_blank">http://localhost:8000</a>.</p>
            </li>
        </ol>
        
        <h2>Uso</h2>
        <h3>Roles y Permisos</h3>
        <ul>
            <li><strong>Administrador:</strong> Puede crear servicios y paquetes, aprobar servicios y solicitudes de agendamiento.</li>
            <li><strong>Usuario Estándar:</strong> Puede agendar servicios, subir fotos a su perfil, y enviar formularios.</li>
        </ul>
        
        <h3>Agendamiento de Servicios</h3>
        <p>Accede a la sección de agendamiento para programar un servicio. Los servicios aprobados por el administrador se mostrarán en el calendario.</p>
        
        <h3>Subida de Fotos</h3>
        <p>Accede a tu perfil para subir y gestionar tus fotos.</p>
        
        <h2>Contribución</h2>
        <p>Si deseas contribuir a este proyecto, por favor sigue estos pasos:</p>
        <ol>
            <li>Haz un fork del repositorio.</li>
            <li>Crea una nueva rama (<code>git checkout -b feature/nueva-caracteristica</code>).</li>
            <li>Realiza tus cambios y haz un commit (<code>git commit -am 'Añadir nueva característica'</code>).</li>
            <li>Haz push a la rama (<code>git push origin feature/nueva-caracteristica</code>).</li>
            <li>Crea un Pull Request.</li>
        </ol>
        
        <h2>Licencia</h2>
        <p>Este proyecto está bajo la licencia MIT. Consulta el archivo <
