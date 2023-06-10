<template>
    <div class="cart-container">
      <h2>Your Cart</h2>
      <div v-if="cartItems.length === 0" class="empty-cart">
        Your cart is empty.
      </div>
      <div v-else>
        <div v-for="(item, index) in cartItems" :key="item.id" class="cart-item">
          <div class="item-details">
            <p class="item-name">{{ item.name }}</p>
            <p>Price: ${{ item.price }}</p>
            <p>Quantity: {{ item.quantity }}</p>
            <p>Total Price: ${{ item.totalPrice }}</p>
          </div>
          <div class="item-actions">
            <button @click="decreaseQuantity(index)" :disabled="item.quantity === 1" class="quantity-btn">-</button>
            <button @click="increaseQuantity(index)" class="quantity-btn">+</button>
            <button @click="removeFromCart(index)" class="remove-btn">Remove</button>
          </div>
        </div>
        <p class="cart-total">Cart Total: ${{ cartTotalPrice }}</p>
      </div>
      <router-link :to="`/order`" class="checkout">CheckOut</router-link>
    </div>
  </template>

  <script>
  import { mapState, mapActions, mapGetters } from 'vuex';

  export default {
    computed: {
      ...mapState(['cartItems']),
      ...mapGetters(['cartItemsCount']),
      ...mapGetters(['cartTotalPrice']),
      ...mapGetters(['cartItems']),
    },
    methods: {
      ...mapActions(['removeFromCart', 'clearCart']),
    increaseQuantity(index) {
      this.$store.commit('increaseQuantity', index);
    },
    decreaseQuantity(index) {
      this.$store.commit('decreaseQuantity', index);
    },
    },
  };
  </script>
<style>
.cart-container {
  max-width: 600px;
  margin: 0 auto;
}

h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

.empty-cart {
  font-style: italic;
  text-align: center;
  margin-bottom: 20px;
}

.cart-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  padding: 10px;
  background-color: #f5f5f5;
}

.item-details {
  flex-grow: 1;
}

.item-name {
  font-weight: bold;
}

.item-actions {
  display: flex;
  align-items: center;
}

.quantity-btn {
  font-size: 16px;
  padding: 5px 10px;
  margin-right: 10px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
}

.remove-btn {
  font-size: 16px;
  padding: 5px 10px;
  background-color: #f44336;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.cart-total {
  font-weight: bold;
  text-align: right;
  margin-top: 20px;
  padding-top: 10px;
  border-top: 1px solid #ccc;
}
.checkout{
    background: aqua;
padding: 10px;
border-radius: 10%;
position: relative;
bottom: 20px;
}
</style>
