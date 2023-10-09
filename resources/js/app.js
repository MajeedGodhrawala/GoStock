import "./bootstrap";

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
});

// import brokerForm from "./components/App/brokerForm.vue";

// const app = createApp({
//     components: {
//       brokerForm,
//     },
// });

// app.mount("#app");


// https://youtu.be/ZiUY7y2AXLM?feature=shared 