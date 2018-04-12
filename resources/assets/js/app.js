require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.component('app', require('./components/App'))

import Task from './pages/Task.vue'

const routes = [
    {
        path: '/task',
        component: Task
    }
]

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
})
