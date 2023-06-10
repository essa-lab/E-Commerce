<template>
    <div>
      <h2 class="heading">Order Details</h2>
      <div v-if="order" class="order-details">
        <p><span class="label">Order Number:</span> {{ order.order_number }}</p>
        <p><span class="label">Shipping Address:</span> {{ order.shipping_address }}</p>
        <p><span class="label">total_amount:</span> {{ order.total_amount }}</p>
        <p><span class="label">user_id:</span> {{ order.user_id }}</p>

        <h3 class="sub-heading">Products:</h3>
        <table class="product-table">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in order.products" :key="product.id">
              <td>{{ product.title }}</td>
              <td>{{ product.pivot.price }}</td>
              <td>{{ product.pivot.quantity }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else class="loading-container">
        <p>Loading...</p>
      </div>
    </div>
  </template>



<script>
export default {
  name: 'OrderDetails',
  data() {
    return {
      order: null,
    };
  },
  created() {
    this.fetchOrderDetails();
  },
  methods: {
    fetchOrderDetails() {
      const orderId = this.$route.params.orderId;

      axios.get(`http://127.0.0.1:8000/api/orders/${orderId}`)
        .then(response => {
          this.order = response.data.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
};
</script>
<style scoped>
.heading {
  font-size: 24px;
  font-weight: bold;
  color: #333;
  margin-bottom: 20px;
}

.sub-heading {
  font-size: 18px;
  font-weight: bold;
  color: #555;
  margin-bottom: 10px;
}

.label {
  font-weight: bold;
  color: #555;
}

.order-details {
  background-color: #f0f0f0;
  padding: 20px;
  border-radius: 5px;
  margin-bottom: 20px;
}

.product-table {
  width: 100%;
  border-collapse: collapse;
}

.product-table th,
.product-table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ccc;
}

.loading-container {
  text-align: center;
  margin-top: 20px;
}
</style>
