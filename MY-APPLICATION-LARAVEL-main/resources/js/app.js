import './import.js';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Theme from './theme';
import PrimeVue from "primevue/config";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) });
        vueApp.use(plugin);
        vueApp.use(ZiggyVue, Ziggy);
        vueApp.use(PrimeVue, {
            ripple: true,
            theme: { 
                preset: Theme,
                options: {
                    prefix: 'p',
                    darkModeSelector: '.my-app-dark',
                }
            }
        });
        vueApp.mount(el);
    },
    progress: {
        color: '#3733ff',
    },
});
