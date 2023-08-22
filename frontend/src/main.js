import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import Vue3ConfirmDialog from "vue3-confirm-dialog";
import "vue3-confirm-dialog/style";
import "vue3-toastify/dist/index.css";

const app = createApp(App);
app.use(router);
app.use(Vue3ConfirmDialog);
app.component("vue3-confirm-dialog", Vue3ConfirmDialog.default);
app.mount("#app");
