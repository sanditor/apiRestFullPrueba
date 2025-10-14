<template>
  <div class="app-container">
    <!-- Encabezado -->
    <header class="app-header shadow-sm">
      <div class="container d-flex flex-wrap justify-content-between align-items-center py-3">
        <h1 class="fs-3 fw-bold text-primary mb-0 text-center text-lg-start">
          Gestión de Recursos
        </h1>
        <!-- 👤 Mostrar nombre del usuario -->
        <div v-if="user" class="text-white me-3 fw-semibold">
          👤 Bienvenido: {{ user.name}}
        </div>
        <button
          v-if="token"
          @click="logoutUser"
          class="btn btn-outline-dark btn-sm mt-2 mt-lg-0"
        >
          <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
        </button>
      </div>
    </header>

    <!-- Contenido -->
    <main class="container my-4">
      <!-- Formulario de Login -->
      <div v-if="!token" class="d-flex justify-content-center align-items-center min-vh-70">
        <div class="card shadow-lg p-4 border-0 rounded-4" style="max-width: 420px; width: 100%;">
          <h2 class="text-center mb-4 text-primary fw-semibold">Bienvenido</h2>
          <Login />
          <p class="text-center text-muted mt-3 mb-0" style="font-size: 0.9rem;">
            Ingresa tus credenciales para continuar
          </p>
        </div>
      </div>

      <!-- Panel principal -->
      <div v-else>
        <div class="row g-4">
          <div class="col-12">
            <UserList />
          </div>
          <div class="col-12">
            <ProductList />
          </div>
          <div class="col-12">
            <BookList />
          </div>
          <div class="col-12">
            <CarList />
          </div>
        </div>
      </div>
    </main>

    <!-- Pie de página -->
    <footer class="text-center py-3 mt-auto bg-light border-top">
      <small class="text-muted">© 2025 Gestión de Recursos - Vue.js + Laravel</small>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Login from './components/Login.vue'
import ProductList from './components/ProductList.vue'
import BookList from './components/BookList.vue'
import CarList from './components/CarList.vue'
import UserList from './components/UserList.vue'
import { logout, getUserById   } from './services/auth'

const token = localStorage.getItem('auth_token')
const userId = localStorage.getItem('id_user')
const user = ref(null)

const logoutUser = async () => {
  try {
    await logout(token)
  } catch (_) {}
  localStorage.removeItem('auth_token')
  window.location.reload()
}
onMounted(async () => {
    if (token && userId) {
    try {
      const response = await getUserById(userId, token)
      user.value = response.data
    } catch (error) {
      console.error('Error al obtener usuario:', error)
    }
  }
})
</script>

<style scoped>
.app-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: #f8f9fa;
}

/* Encabezado */
.app-header {
  background: linear-gradient(90deg, #007bff 0%, #0dcaf0 100%);
  color: white;
}

.app-header h1 {
  color: #fff !important;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* En pantallas pequeñas, ajustar los márgenes */
@media (max-width: 768px) {
  .app-header h1 {
    font-size: 1.5rem;
    text-align: center;
  }
}

/* Altura mínima del contenedor del login */
.min-vh-70 {
  min-height: 70vh;
}

/* Tarjeta de login */
.card {
  transition: all 0.3s ease-in-out;
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
}
</style>
