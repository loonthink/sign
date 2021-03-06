import Vue from 'vue'
import Router from 'vue-router'

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import HelloWorld from '@/components/HelloWorld'
import Login from '@/components/login/login'
import Index from '@/components/index/index'
import Test from '@/testData/login'

Vue.use(ElementUI)

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/he',
      name: 'HelloWorld',
      component: HelloWorld
    }, {
      path: '/',
      name: 'Login',
      component: Login
    }, {
      path: '/test',
      name: 'test',
      component: Test
    }, {
      path: '/index',
      name: 'index',
      component: Index
    }
  ]
})
