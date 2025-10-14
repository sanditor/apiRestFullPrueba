<template>
  <div class="container my-3">
    <h2 class="text-center mb-4 text-primary fw-bold">Productos</h2>

    <form @submit.prevent="crear" class="row g-2 mb-4">
      <div class="col-md-2">
        <label for="">Nombre</label>
        <input v-model="nuevoProducto.nombre" class="form-control" placeholder="Nombre" required />
      </div>
      <div class="col-md-4">
        <label for="">Descripcion</label>
        <input v-model="nuevoProducto.descripcion" type="text" class="form-control" placeholder="Descripcion" required />
      </div>
      <div class="col-md-2">
        <label for="">Cantidad</label>
        <input v-model="nuevoProducto.cantidad" type="number" class="form-control" placeholder="Cantidad" required />
      </div>
      <div class="col-md-2">
        <span for="">Precio</span>
        <input v-model="nuevoProducto.precio" type="number" class="form-control" placeholder="Precio" step="0.01" required />
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100">Agregar</button>
      </div>
    </form>

    <div v-if="productoEditando" ref="editFormProducto" class="mt-4 mb-4">
      <h4 class="text-start mb-2 text-primary fw-bold">Editar Producto</h4>
      <form @submit.prevent="actualizar" class="row g-3 align-items-end">
        <div class="col-md-2">
          <label class="form-label" for="">Nombre</label>
          <input  v-model="productoEditando.nombre" class="form-control" required />
        </div>
        <div class="col-md-4">
          <label class="form-label" for="">Descripcion</label>
          <input v-model="productoEditando.descripcion" class="form-control" required />
        </div>
        <div class="col-md-2">
          <label class="form-label" for="">Cantidad</label>
          <input v-model="productoEditando.cantidad" type="number" class="form-control" required />
        </div>
        <div class="col-md-2">
          <labe class="form-label" for="">Precio</labe>
          <input v-model="productoEditando.precio" type="number" class="form-control" step="0.01" required />
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button class="btn btn-success w-100">Actualizar</button>
        </div>
      </form>
    </div>

    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr class="text-center">
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="producto in productos" :key="producto.id">
          <td>{{ producto.nombre }}</td>
          <td>{{ producto.descripcion }}</td>
          <td>{{ producto.cantidad }}</td>
          <td>${{ producto.precio }}</td>
          <td class="d-flex justify-content-center">
            <button class="btn btn-sm btn-warning me-2" @click="editar(producto)">Editar</button>
            <button class="btn btn-sm btn-danger" @click="eliminar(producto.id)">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>    
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { getProductos, createProducto, updateProducto, deleteProducto } from '../services/api'

const productos = ref([])
const nuevoProducto = ref({ nombre: '', descripcion: '', cantidad: 0, precio: 0 })
const productoEditando = ref(null)

// añadimos el ref para el contenedor de edición
const editFormProducto = ref(null)

const cargarProductos = async () => {
  try {
    const res = await getProductos()
    productos.value = res.data
  } catch (error) {
    console.error('Error al cargar los productos:', error)
    alert('No se pudieron cargar los productos. Verifica la conexión con el servidor.')
  }
}

const crear = async () => {
  try {
    await createProducto(nuevoProducto.value)
    nuevoProducto.value = { nombre: '', descripcion: '', cantidad: 0, precio: 0 }
    await cargarProductos()
  } catch (error) {
    console.error('Error al crear producto:', error)
    alert('No se pudo agregar el producto. Revisa los campos o el servidor.')
  }
}

const editar = async (producto) => {
  try {
    //seteamos el producto
    productoEditando.value = { ...producto }

    //Esperamos a que Vue renderice el formulario
    await nextTick()

    //Hacemos scroll al formulario
    if (editFormProducto.value) {
      editFormProducto.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
  } catch (error) {
    console.error('Error al preparar la edición del producto:', error)
    alert('Ocurrió un error al preparar la edición del producto.')
  }
}

const actualizar = async () => {
  try {
    await updateProducto(productoEditando.value.id, productoEditando.value)
    alert('Carro actualizado correctamente.')

    // Limpiar el formulario de edición (esto lo oculta)
    productoEditando.value = null

    // Recargar la lista actualizada
    await cargarProductos()

    // Desplazar hacia la parte superior de la página
    window.scrollTo({ top: 0, behavior: 'smooth' })

  } catch (error) {
    console.error('Error al actualizar producto:', error)
    alert('No se pudo actualizar el producto. Revisa la conexión o los datos.')
  }
}

const eliminar = async (id) => {
  if (!confirm('¿Deseas eliminar este Producto?')) return
  try {
    await deleteProducto(id)
    await cargarProductos()
    alert('Producto eliminado correctamente.')
  } catch (error) {
    console.error('Error al eliminar Producto:', error)
    alert('No se pudo eliminar el Producto.')
  }
}

onMounted(cargarProductos)
</script>
