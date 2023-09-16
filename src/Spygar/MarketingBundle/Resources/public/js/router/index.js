import Vue from 'vue'
import VueRouter from 'vue-router'
import companiesList from "@/js/views/list";

const routes = [
        { path: '/', name: 'list',  component: companiesList },
];
Vue.use(VueRouter)

const router = new VueRouter({routes});

export default router;