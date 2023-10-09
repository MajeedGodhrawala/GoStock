import "./bootstrap";

import { createApp } from "vue/dist/vue.esm-bundler.js";

import login from "./components/Guest/login.vue";
import register from "./components/Guest/register.vue";

const app = createApp({
    components: {
        login,
        register,
    },
});

app.mount("#app");
