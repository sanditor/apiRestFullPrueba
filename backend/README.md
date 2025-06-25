# 🐘 Backend - API REST Laravel - API Gestor de Recursos

Este backend es una API REST construida con Laravel que permite a usuarios autenticados gestionar sus productos, libros, carros y usuarios (crear, leer, actualizar y eliminar).

## 📋 Requisitos

- PHP >= 8.1
- Composer
- MySQL o MariaDB
- Laravel 10+
- Extensiones PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath

## 🚀 Instalación Local

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve

```

## 🚀 Recomendaciones Importantes

- Asegúrate de configurar correctamente la conexión a tu base de datos en .env.
- Autenticación: Este proyecto usa Laravel Sanctum para manejar la autenticación vía tokens y cookies seguras entre el frontend (SPA) y el backend.

- Rutas API productos:
    GET /productos/ – Listar todos los Productos
    GET /productos/{id} – Mostrar un solo producto por Id
    POST /productos/ – Registrar producto
    PUT /productos/{id} – Actualizar producto
    DELETE /productos/{id} – Eliminar producto

- Rutas API libros:
    GET /libros/ – Listar todos los libros
    GET /libros/{id} – Mostrar un solo libro por Id
    POST /libros/ – Registrar libro
    PUT libross/{id} – Actualizar libro
    DELETE /libros/{id} – Eliminar libro

- Rutas API carros:
    GET /carros/ – Listar todos los Carros
    GET /carros/{id} – Mostrar un solo carro por Id
    POST /carros/ – Registrar carros
    PUT /carros/{id} – Actualizar carros
    DELETE /carros/{id} – Eliminar carros

- Rutas API usurarios:
    GET /users/ – Listar todos los Productos
    GET /users/{id} – Mostrar un solo producto por Id
    POST /register/ – Registrar producto
    PUT /users/{id} – Actualizar producto
    DELETE /users/{id} – Eliminar producto

- Rutas API loguearse:
    POST /login/ – loguearse en la aplicación
    POST /logout/ – Desloguearse en la aplicación



