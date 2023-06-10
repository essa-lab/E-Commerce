<template>
    <div>
      <h2>Orders</h2>
      <div v-if="orders.length > 0">
        <ul class="order-list">
          <li v-for="order in orders" :key="order.id" class="order-item">
            <p class="order-number">Order Number: {{ order.order_number }}</p>
            <p class="order-price">Order Price: {{ order.total_amount }}</p>
            <p class="user-id">User ID: {{ order.user_id }}</p>
            <p class="user-id">shipping address: {{ order.shipping_address}}</p>
            <router-link :to="`/orders/${order.id}`">See Details</router-link>
          </li>
        </ul>
      </div>
      <div v-else>
        <p>No orders found.</p>
      </div>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    name: 'Order',
    data() {
      return {
        orders: [],
      };
    },
    created() {
      this.fetchOrders();
    },
    methods: {
      fetchOrders() {
        axios.get('/api/all-orders')
          .then(response => {
            this.orders = response.data.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
    },
  }
  </script>

  <style scoped>
.order-list {
  list-style-type: none;
  padding: 0;
}

.order-item {
  background-color: #f0f0f0;
  padding: 10px;
  margin-bottom: 10px;
}

.order-number {
  font-weight: bold;
}

.order-price {
  color: green;
}

.user-id {
  color: gray;
}
</style>
