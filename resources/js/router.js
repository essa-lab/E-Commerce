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
import dashboard from './components/Dashboard.vue'
import Order from './components/Order.vue'
import User from './components/user.vue'
import OrderDetails from './components/OrderDetails.vue'

import store from './store';

const isAuth=()=>{
    return store.getters.isAuth;
}

const isAdmin=()=>{
        const storedUser = JSON.parse(localStorage.getItem('user'))
         if(storedUser){
             return storedUser.isAdmin;
         }
         return false;
}
const routes = [
    { path: '/', component:()=> Home },
    {path :'/cart',component:()=>cart},
    { path: '/categories', component:()=> category},
    {path : '/category-products/:catId',component:()=> categoryproduct},
    { path: '/products', component:()=> paginatedProducts },

    { path: '/products/:productId', component:()=> productPage },
    { path: '/login', component:()=> login },

    {path : '/profile',component:()=>profile,
     beforeEnter: (to, from, next) => {
        if (!isAuth()) {
          next('/login');
        } else {
          next();
        }
      },
    },

    {path:'/register',component:()=>register},

    {path:'/order',component:()=>checkout,
    beforeEnter: (to, from, next) => {
        if (!isAuth()) {
          next('/login');
        } else {
          next();
        }
      },
    },

    {path: '/dashboard',
    component:()=> dashboard,
    children: [
      { path: 'products', component: paginatedProducts },
      { path: 'categories', component: category },
      { path: 'all-orders', component: Order },
      { path: 'all-users', component: User },
      {path: '/orders/:orderId', component: OrderDetails,}
    ],
    beforeEnter: (to, from, next) => {
        if (!isAdmin()) {
          next('/');
        } else {
          next();
        }
      },
  },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
  });


export default router;
