<template>

  <div class="container mt-3">
    <div class="d-flex justify-content-lg-evenly align-items-center mb-3">
      <h1 class="mb-0">Gestión de Recursos</h1>
      <button v-if="token" @click="logoutUser" class="btn btn-outline-danger btn-sm">Cerrar sesión</button>
    </div>

    <Login v-if="!token" />
    <div v-else>
      <UserList />
      <ProductList />
      <BookList />
      <CarList />      
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import Login from './components/Login.vue'
  import ProductList from './components/ProductList.vue'
  import BookList from './components/BookList.vue'
  import CarList from './components/CarList.vue'
  import UserList from './components/UserList.vue'
  import { logout } from './services/auth'

  const token = localStorage.getItem('auth_token')

  const logoutUser = async () => {
    try {
      await logout(token)
    } catch (_) {}
    localStorage.removeItem('auth_token')
    window.location.reload()
  }

</script>


