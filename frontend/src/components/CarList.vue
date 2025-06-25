<template>
  <div class="container my-4">
    <h2 class="text-center mb-4">Carros</h2>
    <form @submit.prevent="crear" class="row g-2 mb-4">
        <div class="col-md-3">
            <label for="">Marca:</label><br>
            <input v-model="nuevo.make" placeholder="Marca" required />
        </div>
        <div class="col-md-3">
            <label for="">Módelo:</label><br>
            <input v-model="nuevo.model" placeholder="Modelo" required />
        </div>
        <div class="col-md-2">
            <label for="">Color:</label><br>
            <input v-model="nuevo.color" placeholder="Color" required />
        </div>
        <div class="col-md-2">
            <label for="">Año:</label><br>
            <input v-model="nuevo.year" placeholder="Año" required />
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Agregar</button>
        </div>
    </form>

    <div v-if="editando" ref="editFormCar" class="mt-4 mb-4">
      <h3>Editar Carro</h3>
      <form @submit.prevent="actualizar" class="row g-2">
        <div class="col-md-3">
          <label for="">Marca:</label><br>
          <input v-model="editando.make" placeholder="Marca" required />
        </div>
        <div class="col-md-3">
            <label for="">Modelo:</label><br>
            <input v-model="editando.model" placeholder="Modelo" required />
        </div> 
        <div class="col-md-2">
            <label for="">Color:</label><br>
            <input v-model="editando.color" placeholder="Color" required />
        </div>
        <div class="col-md-2">
            <label for="">Año:</label><br>
            <input v-model="editando.year" placeholder="Año" required />
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-success w-100">Actualizar</button>
        </div>
      </form>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr class="text-center">
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Color</th>
            <th>Acciones</th>
            </tr>
        </thead>
       <tbody>
            <tr v-for="carro in carros" :key="carro.id">
            <td>{{ carro.make }}</td>
            <td>{{ carro.model }}</td>
            <td>{{ carro.year }}</td>
            <td>{{ carro.color }}</td>
            <td class="d-flex justify-content-center">
            <button class="btn btn-sm btn-warning me-2" @click="editar(carro)">Editar</button>
            <button class="btn btn-sm btn-danger" @click="eliminar(carro.id)">Eliminar</button>
            </td>
        </tr>
       </tbody> 
    </table>  
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
  const res = await getCarros()
  carros.value = res.data
}

const crear = async () => {
  await createCarro(nuevo.value)
  nuevo.value = { make: '', model: '', color: '', year: '' }
  await cargar()
}

const editar = async (carro) => {
  //seteamos el carro
  editando.value = { ...carro }

  //Esperamos a que Vue renderice el formulario
  await nextTick()

  //Hacemos scroll al formulario
  if (editFormCar.value) {
    editFormCar.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
}

const actualizar = async () => {
  await updateCarro(editando.value.id, editando.value)
  editando.value = null
  await cargar()
}

const eliminar = async (id) => {
  await deleteCarro(id)
  await cargar()
}

onMounted(cargar)
</script>
