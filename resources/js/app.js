require('./bootstrap');

import { createApp } from 'vue'

import login from './components/User/login.vue'
import register from './components/User/register.vue'
import FeatureProducts from './components/Product/FeatureProducts.vue'
import products from './components/Product/products.vue'
import category from './components/Category/category.vue'
import cart from './components/ChecoutAndCart/cart.vue'
import categoryproduct from './components/Product/categoryproduct.vue'
import productPage from './components/Product/ProductPage.vue'
import paginatedProducts from './components/Product/PaginatedProducts.vue'
import profile from './components/User/profile.vue'
import Layout from './components/Layout.vue'
import checkout from './components/ChecoutAndCart/Checkout.vue'
import store from './store'
import router from './router'
import api from './api';


const app = createApp({})
app.config.globalProperties.$api = api;
app.component('category',category)
app.component('categoryproduct',categoryproduct)
app.component('FeatureProducts',FeatureProducts)
app.component('products',products)
app.component('productPage',productPage)
app.component('paginatedProducts',paginatedProducts)

app.component('Layout',Layout)

app.component('login',login)
app.component('register',register)
app.component('profile',profile)

app.component('cart',cart)
app.component('checkout',checkout)

app.use(store)
app.use(router).mount('#app')
