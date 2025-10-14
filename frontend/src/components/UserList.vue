<template>
    <div class="container my-3">
        <h2 class="text-center mb-4 text-primary fw-bold">Usuarios</h2>

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
                <h4 calss= "text-start mb-2 text-primary fw-bold">Editar Usuario</h4>
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
                    <tr class="text-center" v-for="usuario in usuarios" :key="usuario.id">
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
    try {
        if (!token) return
        const res = await getUsuarios(token)

        usuarios.value = res.data
    } catch (error) {
    console.error('Error al cargar los usuarios:', error)
    alert('No se pudieron cargar los usuarios. Verifica la conexión con el servidor.')
  }
}

const crear = async () => {
    try {
        await createUsuario(nuevo.value, token)
        nuevo.value = { name: '', email: '', password: '' }
        alert('Usuario creado correctamente.')
        await cargar()
    } catch (e) {
        error.value = 'No se pudo agregar el usuario. Revisa los campos o el servidor.'
    }
}

const editar = async (usuario) => {
    try {
        //seteamos el usuario
        editando.value = { ...usuario }

        //Esperamos a que Vue renderice el formulario
        await nextTick()

        //Hacemos scroll al formulario
        if (editFormUser.value) {
            editFormUser.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
        }
    } catch (error) {
        console.error('Error al preparar la edición del usuario:', error)
        alert('Ocurrió un error al preparar la edición del usuario.')
  }

}

const actualizar = async () => {
    try {
        await updateUsuario(editando.value.id, editando.value, token)
         alert('Usuario actualizado correctamente.')

        // Limpiar el formulario de edición (esto lo oculta)
        editando.value = null

        // Recargar la lista actualizada
        await cargar()

        // Desplazar hacia la parte superior de la página
        window.scrollTo({ top: 0, behavior: 'smooth' })

    } catch (error) {
        console.error('Error al actualizar usuario:', error)
        alert('No se pudo actualizar el usuario. Revisa la conexión o los datos.')
  }
}

const eliminar = async (id) => {
    if (!confirm('¿Deseas eliminar este usuario?')) return
        try {
        await deleteUsuario(id, token)
        await cargar()
    } catch (error) {
        console.error('Error al eliminar Usuario:', error)
        alert('No se pudo eliminar el Usuario.')
  }
}

onMounted(cargar)
</script>
