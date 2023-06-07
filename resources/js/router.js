import { createRouter, createWebHistory } from 'vue-router';


import Home from './components/Home.vue'
import profile from './components/User/profile.vue'
import register from './components/User/register'
import category from './components/Category/category.vue'
import cart from './components/ChecoutAndCart/cart.vue'
import categoryproduct from './components/Product/categoryproduct.vue'
import paginatedProducts from './components/Product/PaginatedProducts.vue'
import productPage from './components/Product/ProductPage.vue'
import login from './components/User/login.vue'
import checkout from './components/ChecoutAndCart/Checkout.vue'
const routes = [
    { path: '/', component: Home },
    {path :'/cart',component:cart},
    { path: '/categories', component: category},
    {path : '/category-products/:catId',component: categoryproduct},
    { path: '/products', component: paginatedProducts },
    { path: '/products/:productId', component: productPage },
    { path: '/login', component: login },
    {path : '/profile',component:profile},
    {path:'/register',component:register},
    {path:'/order',component:checkout}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
  });


export default router;
