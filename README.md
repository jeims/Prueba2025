# Proyecto de Gestión de Expedientes

Este es un sistema de gestión de expedientes con roles de usuario (administrador y usuario normal). Los administradores tienen permisos completos para ver, editar y eliminar todos los expedientes, mientras que los usuarios normales solo pueden ver, editar y registrar sus propios expedientes.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas:

-   [PHP](https://www.php.net/downloads.php) >= 8.0
-   [Composer](https://getcomposer.org/) - Gestor de dependencias para PHP
-   [MySQL](https://dev.mysql.com/downloads/) o cualquier base de datos compatible con Laravel
-   [Laravel](https://laravel.com/docs) - Framework de PHP (Laravel 9.x o superior)

## Instalación

Sigue estos pasos para instalar el proyecto en tu máquina local.

1. **Clonar el repositorio:**

    ```bash
    git clone https://github.com/tuusuario/tu-repositorio.git
    ```

2. **Crear .evn:**

    ```bash
    copia de .env.example

    cp .env.example .env

    Asegúrate de establecer los siguientes parámetros:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario_mysql
    DB_PASSWORD=tu_contraseña_mysql
    ```

3. **Instalación de dependencias**

    ```bash
    composer install
    npm install
    npm run dev
    php artisan serve
    ```

4. **Migraciónes y Seeding**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

Este `README.md` contiene los pasos básicos para instalar y configurar un proyecto en Laravel, incluyendo las configuraciones de entorno y cómo ejecutar migraciones y seeders. Puedes adaptarlo a tus necesidades específicas, como configuraciones personalizadas o dependencias adicionales.
