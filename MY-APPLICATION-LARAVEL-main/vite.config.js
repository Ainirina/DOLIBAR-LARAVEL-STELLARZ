// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue';
// import Components from 'unplugin-vue-components/vite';
// import { PrimeVueResolver } from '@primevue/auto-import-resolver';

// export default defineConfig(({ mode }) => ({
//   plugins: [
//     laravel({
//       input: 'resources/js/app.js',
//       refresh: true,
//     }),
//     vue({
//       template: {
//         transformAssetUrls: {
//           base: null,
//           includeAbsolute: false,
//         },
//       },
//     }),
//     Components({
//       resolvers: [PrimeVueResolver()],
//     }),
//   ],
//   build: {
//     outDir: 'public/build',
//     rollupOptions: {
//       output: {
//         manualChunks: undefined,
//       },
//     },
//   },
//   server: mode === 'development' ? {
//     proxy: {
//       '/': {
//         target: 'http://127.0.0.1:8000',
//         changeOrigin: true,
//         secure: false,
//       },
//     },
//     hmr: {
//       host: 'localhost',
//       protocol: 'ws',
//     },
//   } : undefined,
// }));




import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';
import {PrimeVueResolver} from '@primevue/auto-import-resolver';


export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
            resolvers: [
              PrimeVueResolver()
            ]
          })
    ],
    // injection ngrok
    // server: {
    //     host: '0.0.0.0',
    //     port: 5173,
    //     strictPort: true,
    //   },
});
 