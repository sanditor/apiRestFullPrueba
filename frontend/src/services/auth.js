import axios from 'axios'

axios.defaults.withCredentials = true // permite cookies

const API_BASE = 'http://127.0.0.1:8000'

export async function login (credentials) {
    // 1. obtener cookie CSRF primero
    await axios.get(`/sanctum/csrf-cookie`)
    // 2. luego hacer login
    return axios.post(`/api/login`, credentials)
}

// 🔓 LOGOUT
export async function logout (token) {
  await axios.post(`/logout`, {}, {
    headers: { Authorization: `Bearer ${token}` }
  })
}

// 👥 USUARIOS PROTEGIDOS CON AUTH
export async function getUsuarios (token) {
  await axios.get(`/sanctum/csrf-cookie`)
  return axios.get(`/api/users`, {
        headers: { Authorization: `Bearer ${token}` },
    })
}

export async function createUsuario (data, token) {
    await axios.get(`/sanctum/csrf-cookie`)
    // luego hacemos el POST
    return axios.post(`/api/register`, data, {
        headers: { Authorization: `Bearer ${token}` },
    })
}

export async function updateUsuario (id, data, token) {
    await axios.get(`/sanctum/csrf-cookie`)
    return axios.put(`/api/users/${id}`, data, {
        headers: { Authorization: `Bearer ${token}` },
    })
}
export async function deleteUsuario (id, token) {
    await axios.get(`/sanctum/csrf-cookie`)
    return axios.delete(`/api/users/${id}`, {
        headers: { Authorization: `Bearer ${token}` },
    })
}