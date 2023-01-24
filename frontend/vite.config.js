import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
<<<<<<< HEAD
import {fileURLToPath, URL} from "url";
=======
>>>>>>> origin/main

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
<<<<<<< HEAD
  resolve: {
    alias: {
      "@": fileURLToPath (new URL('./src', import.meta.url)),
    },
  },
=======
>>>>>>> origin/main
})
