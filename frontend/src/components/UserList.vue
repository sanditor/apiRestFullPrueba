<template>
    <div class="container my-4">
        <h2 class="text-center mb-4">Usuarios</h2>

        <div v-if="!token">
            <p class="text-danger text-center">Debes iniciar sesión para ver esta sección.</p>
        </div>

        <div v-else>
            <form @submit.prevent="crear" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input v-model="nuevo.name" class="form-control" placeholder="Nombre" required />
                </div>
                <div class="col-md-4">
                    <input v-model="nuevo.email" class="form-control" placeholder="Email" required />
                </div>
                <div class="col-md-3">
                    <input v-model="nuevo.password" type="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Agregar</button>
                </div>
            </form>

            <div v-if="editando" ref="editFormUser" class="mt-4 mb-4">
                <h4>Editar Usuario</h4>
                <form @submit.prevent="actualizar" class="row g-2">
                    <div class="col-md-5">
                        <input v-model="editando.name" class="form-control" required />
                    </div>
                    <div class="col-md-5">
                        <input v-model="editando.email" class="form-control" required />
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Actualizar</button>
                    </div>
                </form>
            </div>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="usuario in usuarios" :key="usuario.id">
                        <td>{{ usuario.name }}</td>
                        <td>{{ usuario.email }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm me-2" @click="editar(usuario)">Editar</button>
                            <button class="btn btn-danger btn-sm" @click="eliminar(usuario.id)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { getUsuarios, createUsuario, updateUsuario, deleteUsuario } from '../services/auth'

const usuarios = ref([])
const nuevo = ref({ name: '', email: '', password: '' })
const editando = ref(null)
const error = ref(null)
const token = localStorage.getItem('auth_token')

// añadimos el ref para el contenedor de edición
const editFormUser = ref(null)

const cargar = async () => {
    if (!token) return
    const res = await getUsuarios(token)

    usuarios.value = res.data
}

const crear = async () => {
    try {
        await createUsuario(nuevo.value, token)
        nuevo.value = { name: '', email: '', password: '' }
        await cargar()
    } catch (e) {
        error.value = 'No autorizado o datos inválidos'
    }
}

const editar = async (usuario) => {
    //seteamos el usuario
    editando.value = { ...usuario }

    //Esperamos a que Vue renderice el formulario
    await nextTick()

    //Hacemos scroll al formulario
    if (editFormUser.value) {
        editFormUser.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
}

const actualizar = async () => {
    await updateUsuario(editando.value.id, editando.value, token)
    editando.value = null
    await cargar()
}

const eliminar = async (id) => {
    await deleteUsuario(id, token)
    await cargar()
}

onMounted(cargar)
</script>
