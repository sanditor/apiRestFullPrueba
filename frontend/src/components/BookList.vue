<template>
  <div class="container my-3">
    <h2 class="text-center mb-4 text-primary fw-bold">Libros</h2>

    <form @submit.prevent="crear" class="row g-2 mb-4">
        <div class="col-md-4">
            <label for="">Título</label><br>
            <input v-model="nuevoLibro.title" placeholder="Título" required />
        </div>
        <div class="col-md-3">
            <label for="">Autor</label><br>
           <input v-model="nuevoLibro.author" placeholder="Autor" required /> 
        </div>
        <div class="col-md-3">
           <label>Fecha Publicación</label><br>
           <input  v-model="nuevoLibro.published_at" placeholder="Fecha Publicación" required /> 
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Agregar</button>
        </div>
    </form>

    <div v-if="libroEditando" ref="editFormBook" class="mt-4 mb-4">
      <h3 class="text-start mb-2 text-primary fw-bold">Editar Libro</h3>
      <form @submit.prevent="actualizar" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label" for="">Título</label><br>
            <input class="form-control" v-model="libroEditando.title" required />
        </div>
        <div class="col-md-4">
           <label class="form-label" for="">Autor</label><br>
           <input class="form-control" v-model="libroEditando.author" required /> 
        </div>
        <div class="col-md-2">
           <label class="form-label" for="">Fecha Publicación</label><br>
           <input class="form-control" v-model="libroEditando.published_at" required /> 
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
  try {
    const res = await getLibros()
    libros.value = res.data
  } catch (error) {
    console.error('Error al cargar los libros:', error)
    alert('No se pudieron cargar los libros. Verifica la conexión con el servidor.')
  }
}

const crear = async () => {
  try {
    await createLibro(nuevoLibro.value)
    nuevoLibro.value = { title: '', author: '' }
    alert('Libro creado correctamente.')
    await cargarLibros()
  } catch (error) {
    console.error('Error al crear libro:', error)
    alert('No se pudo agregar el libro. Revisa los campos o el servidor.')
  }
}

const editar = async (libro) => {
  try {
    //seteamos el libro
    libroEditando.value = { ...libro }

    //Esperamos a que Vue renderice el formulario
    await nextTick()

    //Hacemos scroll al formulario
    if (editFormBook.value) {
      editFormBook.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
  } catch (error) {
    console.error('Error al preparar la edición del libro:', error)
    alert('Ocurrió un error al preparar la edición del libro.')
  }
}

const actualizar = async () => {
  try {
    await updateLibro(libroEditando.value.id, libroEditando.value)
    alert('Libro actualizado correctamente.')
    
    // Limpiar el formulario de edición (esto lo oculta)
    libroEditando.value = null
    
    // Recargar la lista actualizada
    await cargarLibros()

    // Desplazar hacia la parte superior de la página
    window.scrollTo({ top: 0, behavior: 'smooth' })

  } catch (error) {
    console.error('Error al actualizar libro:', error)
    alert('No se pudo actualizar el libro. Revisa la conexión o los datos.')
  }
}

const eliminar = async (id) => {
  if (!confirm('¿Deseas eliminar este carro?')) return
  try {
    await deleteLibro(id)
    await cargarLibros()
    alert('Libro eliminado correctamente.')  
  } catch (error) {
    console.error('Error al eliminar libro:', error)
    alert('No se pudo eliminar el libro.')
  }
}

onMounted(cargarLibros)
</script>
