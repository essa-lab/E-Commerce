<template>
    <div class="profile">
      <h2>Profile</h2>
      <div class="profile-info">
        <p><strong>Name:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
      </div>

      <h3>Orders</h3>
      <ul class="order-list">
        <li v-for="order in orders" :key="order.id" class="order-item">
          <p><strong>Order Number:</strong> {{ order.order_number }}</p>
          <p><strong>Total Amount:</strong> {{ order.total_amount }}</p>
          <p><strong>Shipping Address:</strong> {{ order.shipping_address }}</p>
        </li>
      </ul>
    </div>
  </template>

  <script>
import axios from "axios";

  export default {
    data() {
      return {
        user: null,
        orders: [],
      };
    },
    created() {

      this.fetchUserProfile();
      this.fetchUserOrders();
    },
    methods: {
       fetchUserProfile() {
        const token = localStorage.getItem('token');
        axios
          .get(`http://127.0.0.1:8000/api/profile`,{
            headers: {
             'Authorization': `Bearer ${token}`
             }
            })
          .then((response) => {
            console.log(response)
            this.user = response.data;
            console.log(this.user)

          })

          .catch((error) => {
            console.error('Failed to fetch user orders:', error);
          });
      },
      fetchUserOrders() {
        const token = localStorage.getItem('token');
        axios
          .get(`http://127.0.0.1:8000/api/user-order`,{
            headers: {
             'Authorization': `Bearer ${token}`
             }
            })
          .then((response) => {
            this.orders = response.data;
          })
          .catch((error) => {
            console.error('Failed to fetch user orders:', error);
          });
      },
    },
  };
  </script>

<style scoped>
.profile {
  margin: 20px;
}

.profile h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.profile-info {
  margin-bottom: 20px;
}

.profile-info p {
  margin-bottom: 5px;
}

.order-list {
  list-style-type: none;
  padding: 0;
}

.order-item {
  margin-bottom: 15px;
  border: 1px solid #ccc;
  padding: 10px;
}
</style>
