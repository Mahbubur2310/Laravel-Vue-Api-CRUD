require("./bootstrap");
import Vue from "vue/dist/vue";
window.Vue = require("vue");

import App from "./App.vue";
import Home from "../js/components/Home";
import ContactList from "../js/components/ContactList";
import AddContact from "../js/components/AddContact";
import utils from "../js/helpers/utilities";
Vue.prototype.$utils = utils;

//Sweet Alert 2
import VueSweetalert2 from "vue-sweetalert2";
window.Swal = require("sweetalert2");
Vue.use(VueSweetalert2);
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import axios from "axios";
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const routes = [
    {
        name: "home",
        path: "/",
        component: Home,
    },
    {
        name: "contacts",
        path: "/contacts",
        component: ContactList,
    },
    {
        name: "add_contacts",
        path: "/add_contacts",
        component: AddContact,
    },
];

const router = new VueRouter({ mode: "history", routes: routes });
const app = new Vue(Vue.util.extend({ router }, App)).$mount("#app");

// require("./bootstrap");
// import Vue from "vue/dist/vue";
// window.Vue = require("vue");

// import App from "./App.vue";
// import Home from "../js/components/Home";
// import ContactList from "../js/components/ContactList";
// import VueAxios from "vue-axios";
// import VueRouter from "vue-router";
// import axios from "axios";

// Vue.use(VueRouter);
// Vue.use(VueAxios, axios);

// const routes = [
//     {
//         name: "home",
//         path: "/",
//         component: Home,
//     },
//     {
//         name: "contacts",
//         path: "/contacts",
//         component: ContactList,
//     },
// ];

// const router = new VueRouter({ mode: "history", routes: routes });
// const app = new Vue(Vue.util.extend({ router }, App)).$mount("#app");
