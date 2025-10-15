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

```
Método	URI	Acción
POST	/api/login	Autenticación
POST	/api/register	Crear usuario
GET	/api/users	Listar usuarios
PUT	/api/users/:id	Actualizar usuario
DELETE	/api/users/:id	Eliminar usuario
GET	/api/productos	Listar productos
CRUD	/api/productos	Operaciones CRUD

```

### Intalación Local Backend (Laravel)

```bash
git clone https://github.com/tuusuario/apiRestFullPrueba.git
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate 
php artisan serve
```

### Instrucciones posteriores de configuración de entorno (.env examples)

En el archivo: .env ya creado agregar estas lineas de código y pues crear la BBDD en su mysql editor con el nombre de la variable: DB_DATABASE

APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.1:8000

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_apirestfullprueba
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

SESSION_DOMAIN=127.0.0.1
SANCTUM_STATEFUL_DOMAINS=127.0.0.1:5173

SESSION_SAME_SITE=lax
SESSION_SECURE_COOKIE=false    

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

```

### ⚙️ Instalación Local Frontend(Vue.js)

```bash
cd frontend
npm install
npm run dev

```

- Asegúrate que el backend Laravel esté corriendo en http://localhost:8000

- Loguearse con esta credenciales en el frontend:
        usuario: admin@admin.com
        psw: Prueba123


## Estructura del proyecto

```

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

```

Las rutas siguen la convención RESTful típica de Laravel. El archivo api.js centraliza todas las llamadas a estas rutas.

## Funcionalidades

- Login persistente con token
- Logout con eliminación del token
- Interfaz con Bootstrap 5
- CRUD dinámico con formularios y validación básica

## 🧑‍💼 Autor

Sandor Luque Farfán
Desarrollador Full Stack Junior (Laravel / Vue.js)
📧 sanditorl1978@gmail.com

## 🏁 Licencia

Este proyecto se distribuye bajo la licencia MIT, y su código puede ser utilizado con fines educativos y demostrativos.






