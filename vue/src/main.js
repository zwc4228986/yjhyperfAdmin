import ElementPlus from "element-plus";
import "element-plus/dist/index.css";
import "element-plus/theme-chalk/display.css";
import '@icon-park/vue-next/styles/index.css';
import scui from "./scui";
import i18n from "./locales";
import router from "./router";
import store from "./store";
import { createApp } from "vue";
import App from "./App.vue";
import YjUI from "./yjcomponents/index";
import websocket from "@/imi-server/websocket";

import {install} from '@icon-park/vue-next/es/all';

const app = createApp(App);
install(app, 'i');

app.use(store);
app.use(router);
app.use(ElementPlus);
app.use(i18n);
app.use(scui);
app.use(YjUI)
app.use(websocket);

//挂载app
app.mount("#app");
