# 📦 Vue API CRUD Frontend

Frontend desarrollado con **Vue.js 3 + Vite** para consumir una API RESTful de Laravel. Este proyecto permite realizar operaciones **CRUD (Crear, Leer, Actualizar y Eliminar)** para los siguientes recursos:

- 🛒 Productos
- 📚 Libros
- 🚗 Carros
- 👤 Usuarios
- Autenticación de usuario con login, logout y token
- Gestión de usuarios autenticados protegida por middleware `auth:sanctum

---

## 🧰 Tecnologías usadas

- [Vue.js 3](https://vuejs.org/)
- [Vite](https://vitejs.dev/)
- [Axios](https://axios-http.com/)

---

## 🛠 Requisitos

- Node.js
- Backend Laravel configurado con Sanctum (`/api` funcionando)
- CORS habilitado para localhost:5173

---

## ⚙️ Instalación Local

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
