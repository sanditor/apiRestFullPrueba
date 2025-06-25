<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    <form @submit.prevent="loguear" class="row g-2 justify-content-center" novalidate>
      <div class="col-md-4">
        <input v-model="email" class="form-control" type="email" placeholder="Email" required />
      </div>
      <div class="col-md-4">
        <input v-model="password" class="form-control" type="password" placeholder="Contraseña" required />
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100">Entrar</button>
      </div>
    </form>

    <div v-if="error" class="alert alert-danger mt-3 text-center">{{ error }}</div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { login } from '../services/auth'

const email = ref('')
const password = ref('')
const error = ref(null)

async function loguear() {
  try {
    const res = await login({ email: email.value, password: password.value })
    const token = res.data.token
    localStorage.setItem('auth_token', token)
    window.location.reload() // recarga para habilitar vistas protegidas
  } catch (e) {
    error.value = 'Credenciales incorrectas'
  }
}
</script>
