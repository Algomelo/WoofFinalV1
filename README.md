<h1>ohmywoof: Un sistema de gestión de servicios web con autenticación, roles y más </h1><br>
Descripción general
ohmywoof es una aplicación web construida con Laravel 10 diseñada para. Ofrece un conjunto completo de características, incluyendo: <br>

Autenticación de usuarios: Permite a los usuarios registrarse e iniciar sesión de forma segura. <br>
Sistema de roles: Define diferentes roles de usuario (usuario, administrador) con permisos específicos. <br>
Agendamiento de servicios: Facilita la programación de citas y servicios con integración de calendario. <br>
Subida de fotos: Los usuarios pueden subir fotos a sus perfiles. <br>
Gestión de servicios y paquetes: Los administradores pueden crear y gestionar servicios y paquetes. <br>
Aprobación de servicios y solicitudes: Los administradores pueden aprobar o rechazar servicios y solicitudes de agendamiento. <br>
Formularios de contacto: Los formularios enviados a través de la web se registran en el sistema.<br>
Tecnologías utilizadas: <br>
Laravel 10: Framework PHP para desarrollo web. <br>
Javascript: Para el desarrollo de funcionalidades front.   <br>
Bootstrap: Framework para el desarrollo de interfaces responsivas.<br>

Instalación <br>
Clonar el repositorio:
Bash
git clone https://github.com/tu-usuario/ohmywoof.git

Instalar dependencias:
Bash
composer install

Copiar el archivo .env.example:
Bash
cp .env.example .env

Configurar la base de datos: Editar el archivo .env con tus credenciales de base de datos.
Ejecutar las migraciones:
Bash
php artisan migrate

Generar una clave de aplicación:
Bash
php artisan key:generate

Uso
Para iniciar el servidor de desarrollo:

Bash
php artisan serve

Contribuciones
Las contribuciones son bienvenidas! Si encuentras algún error o deseas agregar nuevas funcionalidades, por favor, crea un pull request.
