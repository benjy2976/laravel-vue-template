import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

const HMR_HOST = process.env.VITE_HMR_HOST || 'localhost'
const HMR_PORT = Number(process.env.VITE_HMR_PORT || 5173)
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
    host: '0.0.0.0',       // escucha dentro del contenedor
    port: HMR_PORT,
    strictPort: true,
    hmr: {
      host: HMR_HOST,      // host público para el navegador
      port: HMR_PORT,
      protocol: 'http',
    },
  },

});
