import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Login.vue'
import MainApp from '../views/MainApp.vue'

import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Setting from '../views/Setting.vue'

import UserIndex from '../views/user/index.vue'
import UserCreate from '../views/user/create.vue'
import UserEdit from '../views/user/edit.vue'

import ProductIndex from '../views/product/index.vue'
import ProductCreate from '../views/product/create.vue'
import ProductEdit from '../views/product/edit.vue'

import CategoryIndex from '../views/category/index.vue'

Vue.use(VueRouter)

const routes = [
    { path: '/login', name: 'login', component: Login },
    {
        path: '/', name: 'MainApp', component: MainApp,
        children: [
            { path: '', name: 'home', component: Home, },
            { path: '/about', name: 'about', component: About },
            { path: '/setting', name: 'setting', component: Setting },
            {
                path: '/user', component: UserIndex,
                children: [
                    // { path: 'create', name: 'user.create', components: { default: UserIndex, dialog: UserCreate } },
                    { path: 'create', name: 'user.create', components: { dialog: UserCreate } },
                    { path: 'edit', name: 'user.edit', components: { dialog: UserEdit } },
                    { path: 'createplat', name: 'user.createplat', component: () => import('../views/user/createplat.vue') },
                    { path: 'editplat/:id', name: 'user.editplat', component: () => import('../views/user/editplat.vue') }
                ]
            },
            {
                path: '/product', component: () => import('../views/layout.vue'),
                children: [
                    // { path: '', name: 'product', component: () => import('../views/layout.vue') },
                    { path: '', name: 'product', component: ProductIndex },
                    // { path: 'create', name: 'product.create', components: { dialog: ProductCreate } },
                    // { path: 'edit', name: 'product.edit', components: { dialog: ProductEdit } },
                    // { path: 'create', name: 'product.create', component: () => import('../views/product/createplat.vue') },
                    // { path: 'edit', name: 'product.edit', component: () => import('../views/product/editplat.vue') }
                    { path: 'create', name: 'product.create', component: ProductCreate },
                    { path: 'edit', name: 'product.edit', component: ProductEdit }
                ]
            },
            {
                path: '/category', component: () => import('../views/layout.vue'),
                children: [
                    { path: '', name: 'category', component: CategoryIndex }
                ]
            }
        ]
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})


export default router