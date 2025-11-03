import { createApp, h } from "vue";
import App from "./App.vue";
import router from "./router/index";
import "../css/app.css";

createApp(App).use(router).mount("#app");
