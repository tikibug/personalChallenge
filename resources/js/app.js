import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '../css/app.css'
import PrimeVue from 'primevue/config'
import Aura from '@primeuix/themes/aura'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            app.use(plugin)
        app.use(PrimeVue, {
            theme: {
                preset: Aura,
                options: {
                    prefix: 'p',
                    darkModeSelector: false,
                    cssLayer: false,
                    cssVariables: true
                }
            }
        });
            app.mount(el)
    },
})
