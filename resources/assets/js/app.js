require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.component('app', require('./components/App'))

import Index from './pages/Index'
import Task from './pages/Task'
import TaskEdit from './pages/TaskEdit'
import TaskOld from './pages/TaskOld'
import TaskOldEdit from './pages/TaskOldEdit'
import Config from './pages/Config'
import Rank from './pages/Rank'

const routes = [
    {
        path: '/',
        component: Index
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
        path: '/config',
        component: Config
    }
]

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
})
