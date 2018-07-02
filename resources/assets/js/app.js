require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(VueRouter)
Vue.use(Vuex)

Vue.component('app', require('./components/App'))

import Index from './pages/Index'
import Signup from './pages/Signup'
import Task from './pages/Task'
import TaskEdit from './pages/TaskEdit'
import TaskOld from './pages/TaskOld'
import TaskOldEdit from './pages/TaskOldEdit'
import Mypage from './pages/Mypage'
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
    path: '/mypage',
    component: Mypage
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
    signedIn: false
  },
  getters: {
    signedIn: state => {
      return state.signedIn
    }
  },
  mutations: {
    setSignedIn: (state, bool) => {
      state.signedIn = bool
    }
  }
})

const app = new Vue({
  el: '#app',
  router,
  store,
})
