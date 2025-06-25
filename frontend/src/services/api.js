import axios from 'axios';

const API_BASE = '/api';

// Recupera el token de localStorage
function authHeader() {
  const token = localStorage.getItem('auth_token')
  return token ? { Authorization: `Bearer ${token}` } : {}
}

//Productos
export const getProductos = () => axios.get(`${API_BASE}/productos`, { headers: authHeader() });
export const getProducto = (id) => axios.get(`${API_BASE}/productos/${id}`, { headers: authHeader() });
export const createProducto = (data) => axios.post(`${API_BASE}/productos`, data, { headers: authHeader() });
export const updateProducto = (id, data) => axios.put(`${API_BASE}/productos/${id}`, data, { headers: authHeader() });
export const deleteProducto = (id) => axios.delete(`${API_BASE}/productos/${id}`, { headers: authHeader() });

// Libros
export const getLibros = () => axios.get(`${API_BASE}/libros`, { headers: authHeader() });
export const getLibro = (id) => axios.get(`${API_BASE}/libros/${id}`, { headers: authHeader() });
export const createLibro = (data) => axios.post(`${API_BASE}/libros`, data, { headers: authHeader() });
export const updateLibro = (id, data) => axios.put(`${API_BASE}/libros/${id}`, data, { headers: authHeader() });
export const deleteLibro = (id) => axios.delete(`${API_BASE}/libros/${id}`, { headers: authHeader() });

// Carros
export const getCarros = () => axios.get(`${API_BASE}/carros`, { headers: authHeader() });
export const getCarro = (id) => axios.get(`${API_BASE}/carros/${id}`, { headers: authHeader() });
export const createCarro = (data) => axios.post(`${API_BASE}/carros`, data, { headers: authHeader() });
export const updateCarro = (id, data) => axios.put(`${API_BASE}/carros/${id}`, data, { headers: authHeader() });
export const deleteCarro = (id) => axios.delete(`${API_BASE}/carros/${id}`, { headers: authHeader() });