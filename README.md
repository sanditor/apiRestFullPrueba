# Proyecto Ejemplo: Gestor de Recursos Laravel + Vue.js 3 (FullStack)

Este es un proyecto completo de aplicación de gestión de Recursos usando Laravel como backend y Vue 3 como frontend. Ambos están organizados en carpetas `/backend` y `/frontend`.

---

## 🚀 Requisitos

- Node.js >= 18
- PHP >= 8.1
- Composer
- MySQL
- Laravel CLI
- Vue vite

## 🧪 Rutas principales (Laravel)

Método	URI	Acción
POST	/api/login	Autenticación
POST	/api/register	Crear usuario
GET	/api/users	Listar usuarios
PUT	/api/users/:id	Actualizar usuario
DELETE	/api/users/:id	Eliminar usuario
GET	/api/productos	Listar productos
CRUD	/api/productos	Operaciones CRUD

### Intalación Backend (Laravel)

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate 
php artisan serve

## 📂 Estructura del Proyecto
```
project-root/
│
├── backend/               # Laravel API REST con autenticación Sanctum
│   ├── README.md          # Instrucciones para instalar y ejecutar
│   ├── backend/                # Proyecto Laravel (API)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── routes/
│   │   └── api.php
│   ├── storage/
│   ├── tests/
│   ├── .env.example
│   ├── composer.json
│   └── ...
│   ├── BookController.php
│   ├── CarController.php
│   ├── CarController.php
│   └── UserController.php
│
├── frontend/
├── package.json              # Configuración del proyecto
├── vite.config.js            # (Opcional) configuración de Vite
├── src/
│   ├── main.js               # Entrada principal de la app
│   ├── App.vue               # Componente raíz
│   ├── services/
│   │   └── api.js            # Servicios Axios para consumir la API Laravel
        └── auth.js           # Autenticación y gestión de usuarios
│   └── components/
        ├── Login.vue        # Formulario de acceso
│       ├── ProductList.vue  # Componente CRUD de productos
│       ├── BookList.vue     # Componente CRUD de libros
│       ├── CarList.vue      # Componente CRUD de carros
│       └── UserList.vue     # Componente CRUD de usuarios
│
└── .gitignore             # Incluye Laravel y Node exclusions


### ⚙️ Instalación Local Frontend(Vue.js)

```bash
git clone https://github.com/tuusuario/apiRestFullPrueba.git
cd frontend
npm install
npm run dev

```

- Asegúrate que el backend Laravel esté corriendo en http://localhost:8000


## Estructura del proyecto

frontend/
├── package.json              # Configuración del proyecto
├── vite.config.js            # (Opcional) configuración de Vite
├── src/
│   ├── main.js               # Entrada principal de la app
│   ├── App.vue               # Componente raíz
│   ├── services/
│   │   └── api.js            # Servicios Axios para consumir la API Laravel
        └── auth.js           # Autenticación y gestión de usuarios
│   └── components/
        ├── Login.vue        # Formulario de acceso
│       ├── ProductList.vue  # Componente CRUD de productos
│       ├── BookList.vue     # Componente CRUD de libros
│       ├── CarList.vue      # Componente CRUD de carros
│       └── UserList.vue     # Componente CRUD de usuarios

## Rutas de la API Laravel

| Recurso   | Endpoint         | Métodos disponibles    |
| --------- | ---------------- | ---------------------- |
| Productos | `/api/productos` | GET, POST, PUT, DELETE |
| Libros    | `/api/books`     | GET, POST, PUT, DELETE |
| Carros    | `/api/cars`      | GET, POST, PUT, DELETE |
| Usuarios  | `/api/users`     | GET, POST, PUT, DELETE |

Las rutas siguen la convención RESTful típica de Laravel. El archivo api.js centraliza todas las llamadas a estas rutas.

## Funcionalidades

- Login persistente con token
- Logout con eliminación del token
- Interfaz con Bootstrap 5
- CRUD dinámico con formularios y validación básica





