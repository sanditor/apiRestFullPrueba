import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  server: {
    host: '127.0.0.1',
    port: 5173,
    strictPort: true, // falla si el puerto ya está en uso
     proxy: {
      // proxyea todo /api/... a tu Laravel
      '/api': {
        target: 'http://127.0.0.1:8000', // tu backend
        changeOrigin: true,
        rewrite: path => path.replace(/^\/api/, '/api')
      },
      // y también el endpoint de CSRF
      '/sanctum': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
        rewrite: path => path.replace(/^\/sanctum/, '/sanctum')
      }
    }
  }
})
