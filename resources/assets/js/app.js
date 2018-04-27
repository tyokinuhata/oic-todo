require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(Vuex)
Vue.use(VueRouter)

Vue.component('app', require('./components/App'))

import Index from './pages/Index'
import Signup from './pages/Signup'
import Task from './pages/Task'
import TaskEdit from './pages/TaskEdit'
import TaskOld from './pages/TaskOld'
import TaskOldEdit from './pages/TaskOldEdit'
import User from './pages/User'
import Config from './pages/Config'
import Rank from './pages/Rank'

const routes = [
    {
        path: '/',
        component: Index
    },
    {
        path: '/signup',
        component: Signup
    },
    {
        path: '/task',
        component: Task
    },
    {
        path: '/task/edit',
        component: TaskEdit
    },
    {
        path: '/task/old',
        component: TaskOld
    },
    {
        path: '/task/old/edit',
        component: TaskOldEdit
    },
    {
        path: '/rank',
        component: Rank
    },
    {
        path: '/user/:id',
        component: User
    },
    {
        path: '/config',
        component: Config
    }
]

const router = new VueRouter({
    routes
})

const store = new Vuex.Store({
    state: {

    },
    getters: {

    },
    mutations: {

    },
    actions: {

    }
})

const app = new Vue({
    el: '#app',
    router,
    store
})
