# Proyecto Ejemplo: Gestor de Recursos

Este es un proyecto completo de aplicación de gestión de Recursos usando Laravel como backend y Vue 3 como frontend. Ambos están organizados en carpetas `/backend` y `/frontend`.

---

## Autenticación

/api/login: Login de usuario (POST)
/api/logout: Cierre de sesión (POST)
/api/usuarios: Listar usuarios (GET, requiere token)
/api/register: Crear usuario (POST, requiere token)
/api/users/{id}: PUT/DELETE para actualizar y eliminar (token)
El token de acceso se guarda en localStorage como auth_token. 

## 📂 Estructura del Proyecto
```
project-root/
│
├── backend/               # Laravel API REST con autenticación Sanctum
│   ├── README.md          # Instrucciones para instalar y ejecutar
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





