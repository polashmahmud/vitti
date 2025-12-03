import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { initializeTheme } from './composables/useAppearance';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),

    resolve: (name) => {
        if (name.includes('::')) {
            const [module, page] = name.split('::');

            const modulePages = import.meta.glob<DefineComponent>('../../modules/**/resources/pages/**/*.vue');

            const path = `../../modules/${module}/resources/pages/${page}.vue`;

            if (path in modulePages) {
                return modulePages[path]().then((m) => m.default);
            }
            console.error(`Module page not found: ${path}`);
        }

        return resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        );
    },

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
