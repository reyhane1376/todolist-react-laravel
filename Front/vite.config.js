import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    host: '0.0.0.0',  // Make Vite accessible externally
    port: 5173,        // Ensure the port matches the one in docker-compose
  },
})
