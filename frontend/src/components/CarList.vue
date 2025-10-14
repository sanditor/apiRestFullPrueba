<template>
  <div class="container-fluid my-3">
  <h2 class="text-center mb-4 text-primary fw-bold">Carros</h2>

  <!-- Formulario Crear -->
  <form @submit.prevent="crear" class="row g-3 align-items-end mb-4">
    <div class="col-md-3">
      <label class="form-label">Marca</label>
      <input
        v-model="nuevo.make"
        type="text"
        placeholder="Marca"
        required
        class="form-control"
      />
    </div>
    <div class="col-md-3">
      <label class="form-label">Modelo</label>
      <input
        v-model="nuevo.model"
        type="text"
        placeholder="Modelo"
        required
        class="form-control"
      />
    </div>
    <div class="col-md-2">
      <label class="form-label">Color</label>
      <input
        v-model="nuevo.color"
        type="color"
        required
        class="form-control form-control-color"
      />
    </div>
    <div class="col-md-2">
      <label class="form-label">Año</label>
      <input
        v-model="nuevo.year"
        type="number"
        placeholder="Año"
        required
        class="form-control"
      />
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100">
        <i class="bi bi-plus-circle me-1"></i> Agregar
      </button>
    </div>
  </form>

  <!-- Formulario Editar -->
  <div v-if="editando" ref="editFormCar" class="mt-4 mb-4">
    <h3 class="text-start mb-2 text-primary fw-bold">Editar Carro</h3>
    <form @submit.prevent="actualizar" class="row g-3 align-items-end">
      <div class="col-md-3">
        <label class="form-label">Marca</label>
        <input
          v-model="editando.make"
          type="text"
          placeholder="Marca"
          required
          class="form-control"
        />
      </div>
      <div class="col-md-3">
        <label class="form-label">Modelo</label>
        <input
          v-model="editando.model"
          type="text"
          placeholder="Modelo"
          required
          class="form-control"
        />
      </div>
      <div class="col-md-2">
        <label class="form-label">Color</label>
        <input
          v-model="editando.color"
          type="color"
          required
          class="form-control form-control-color"
        />
      </div>
      <div class="col-md-2">
        <label class="form-label">Año</label>
        <input
          v-model="editando.year"
          type="number"
          placeholder="Año"
          required
          class="form-control"
        />
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-success w-100">
          <i class="bi bi-check-circle me-1"></i> Actualizar
        </button>
      </div>
    </form>
  </div>

  <!-- Tabla -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Año</th>
          <th>Color</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="carro in carros" :key="carro.id" class="text-center">
          <td>{{ carro.make }}</td>
          <td>{{ carro.model }}</td>
          <td>{{ carro.year }}</td>
          <td>
            <div
              :style="{
                backgroundColor: carro.color,
                width: '25px',
                height: '25px',
                borderRadius: '4px',
                margin: 'auto'
              }"
            ></div>
          </td>
          <td>
            <div class="d-flex justify-content-center gap-2">
              <button
                class="btn btn-warning btn-sm"
                @click="editar(carro)"
              >
                <i class="bi bi-pencil-square"></i> Editar
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="eliminar(carro.id)"
              >
                <i class="bi bi-trash"></i> Eliminar
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { getCarros, createCarro, updateCarro, deleteCarro } from '../services/api'

const carros = ref([])
const nuevo = ref({ make: '', model: '', color: '', year: '' })
const editando = ref(null)

// añadimos el ref para el contenedor de edición
const editFormCar = ref(null)

const cargar = async () => {
  try {
    const res = await getCarros()
    carros.value = res.data
  } catch (error) {
    console.error('Error al cargar los carros:', error)
    alert('No se pudieron cargar los carros. Verifica la conexión con el servidor.')
  }
}

const crear = async () => {
  try {
    await createCarro(nuevo.value)
    nuevo.value = { make: '', model: '', color: '', year: '' }
    alert('Carro creado correctamente.')
    await cargar()
  } catch (error) {
    console.error('Error al crear carro:', error)
    alert('No se pudo agregar el carro. Revisa los campos o el servidor.')
  }
}

const editar = async (carro) => {
  try {
    //seteamos el carro
    editando.value = { ...carro }

    //Esperamos a que Vue renderice el formulario
    await nextTick()    

    //Hacemos scroll al formulario
    if (editFormCar.value) {
      editFormCar.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
  } catch (error) {
    console.error('Error al preparar la edición del carro:', error)
    alert('Ocurrió un error al preparar la edición del carro.')
  }
}

const actualizar = async () => {
  try {
    await updateCarro(editando.value.id, editando.value)
    alert('Carro actualizado correctamente.')

    // Limpiar el formulario de edición (esto lo oculta)
    editando.value = null
    
    // Recargar la lista actualizada
    await cargar()

    // Desplazar hacia la parte superior de la página
    window.scrollTo({ top: 0, behavior: 'smooth' })

  } catch (error) {
    console.error('Error al actualizar carro:', error)
    alert('No se pudo actualizar el carro. Revisa la conexión o los datos.')
  }
  
}

const eliminar = async (id) => {
  if (!confirm('¿Deseas eliminar este carro?')) return
  try {
    await deleteCarro(id)
    await cargar()
    alert('Carro eliminado correctamente.')  
  } catch (error) {
    console.error('Error al eliminar carro:', error)
    alert('No se pudo eliminar el carro.')
  }
}

onMounted(cargar)
</script>
