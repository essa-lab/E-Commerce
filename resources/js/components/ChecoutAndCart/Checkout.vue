<template>
    <form @submit="placeOrder">
      <h2>Checkout</h2>

      <label for="shipping-address">Shipping Address:</label>
      <input type="text" id="shipping-address" v-model="shippingAddress" :class="{ 'is-invalid': shippingAddressError }">
      <span v-if="shippingAddressError" class="error-message">Please enter a valid shipping address.</span>

      <button type="submit">Place Order</button>
    </form>
  </template>

  <script>
  export default {
    data() {
      return {
        shippingAddress: '',
        shippingAddressError: '',
      };
    },
    methods: {
      async placeOrder(event) {
        event.preventDefault();

        this.shippingAddressError = '';

        if (!this.shippingAddress) {
          this.shippingAddressError = 'Please enter a valid shipping address.';
        }


        try {
         const cartItems = JSON.parse(localStorage.getItem('cart_items')) || [];

        const orderData = {
        items: cartItems,
        ship:this.shippingAddress
         };
         const token = localStorage.getItem('token');
         axios.post('/api/order', orderData, {
  headers: {
    'Authorization': `Bearer ${token}`
  }
})
            localStorage.removeItem('cart_items');
        } catch (error) {

            console.error('Failed to place the order:', error);
  }
        this.shippingAddress = '';

      },
    },
  };
  </script>

  <style>
  .is-invalid {
    border: 1px solid red;
  }

  .error-message {
    color: red;
    font-size: 12px;
    margin-top: 4px;
  }
  </style>
