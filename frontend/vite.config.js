import { defineConfig } from "vite"
import path from "path"
import react from "@vitejs/plugin-react-swc"

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    // Backend: MAMP Apache = 8888 (8889 è MySQL in Database.php)
    proxy: {
      "/api": {
        target: "http://localhost:8888/bellaitaliahomes/backend/public",
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/api/, ""),
      },
    },
  },
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
    },
  },
  extensions: [".js", ".jsx", ".json", ".ts", ".tsx"],
})
