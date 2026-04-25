import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    host: true,       // 🔥 permite acceso desde fuera del contenedor
    port: 5173,       // 🔥 coincide con tu docker-compose
    strictPort: true, // evita que cambie de puerto automáticamente
  }
})
