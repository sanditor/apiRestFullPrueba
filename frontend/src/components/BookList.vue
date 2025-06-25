<template>
  <div class="container my-4">
    <h2 class="text-center mb-4">Libros</h2>

    <form @submit.prevent="crear" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="">Título</label><br>
            <input v-model="nuevoLibro.title" placeholder="Título" required />
        </div>
        <div class="col-md-4">
            <label for="">Autor</label><br>
           <input v-model="nuevoLibro.author" placeholder="Autor" required /> 
        </div>
        <div class="col-md-2">
           <label>Fecha Publicación</label><br>
           <input  v-model="nuevoLibro.published_at" placeholder="Fecha Publicación" required /> 
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Agregar</button>
        </div>
    </form>

    <div v-if="libroEditando" ref="editFormBook" class="mt-4 mb-4">
      <h3>Editar Libro</h3>
      <form @submit.prevent="actualizar" class="row g-2">
        <div class="col-md-4">
            <label for="">Título</label><br>
            <input v-model="libroEditando.title" required />
        </div>
        <div class="col-md-4">
           <label for="">Autor</label><br>
           <input v-model="libroEditando.author" required /> 
        </div>
        <div class="col-md-2">
           <label for="">Fecha Publicación</label><br>
           <input v-model="libroEditando.published_at" required /> 
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button class="btn btn-success w-100">Actualizar</button>
        </div>
      </form>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr class="text-center">
            <th>Título</th>
            <th>Autor</th>
            <th>Año de Publicación</th>
            <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="libro in libros" :key="libro.id">
                <td>{{ libro.title }}</td>
                <td>{{ libro.author }}</td>
                <td>{{ libro.published_at }}</td>
                <td class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-warning me-2" @click="editar(libro)">Editar</button>
                    <button class="btn btn-sm btn-danger" @click="eliminar(libro.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>    
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { getLibros, createLibro, updateLibro, deleteLibro } from '../services/api'

const libros = ref([])
const nuevoLibro = ref({ title: '', author: '', published_at: '' })
const libroEditando = ref(null)

// añadimos el ref para el contenedor de edición
const editFormBook = ref(null)

const cargarLibros = async () => {
  const res = await getLibros()
  libros.value = res.data
}

const crear = async () => {
  await createLibro(nuevoLibro.value)
  nuevoLibro.value = { title: '', author: '' }
  await cargarLibros()
}

const editar = async (libro) => {
  //seteamos el libro
  libroEditando.value = { ...libro }

  //Esperamos a que Vue renderice el formulario
  await nextTick()

  //Hacemos scroll al formulario
  if (editFormBook.value) {
    editFormBook.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
}

const actualizar = async () => {
  await updateLibro(libroEditando.value.id, libroEditando.value)
  libroEditando.value = null
  await cargarLibros()
}

const eliminar = async (id) => {
  await deleteLibro(id)
  await cargarLibros()
}

onMounted(cargarLibros)
</script>
