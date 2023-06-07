
<template>
      <div>
          <div class="product-image">
            <img :src="getImageUrl(product.image)" :alt="product.name" />
          </div>
          <div class="product-detail">
          <div class="product-info">
            <span class="product-name">{{ product.title }}</span>
            <span class="product-price">Price: {{ product.price }}</span>
            <button @click="addToCart(product)" class="add-to-cart-btn">Add to Cart</button>
            <router-link :to="`/products/${product.id}`">See More</router-link>
          </div>
        </div>



    </div>
  </template>

<script>
import Layout from '../Layout.vue';
import { mapActions } from 'vuex';
export default {
    name: 'products',
  components: {
    Layout,
  },
    props: {
    product:{
        type: Object,
        required:true
    },
  },

    methods: {
        ...mapActions(['addToCart']),
         addToCart(item) {
            this.$store.dispatch('addToCart', item);
        },
         getImageUrl(image) {
             return `/storage/${image}`;
        }
    },
};
</script>
<style scoped>
.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.product-item {
  width: 300px;
  margin-bottom: 20px;
  padding: 10px;
  background-color: #f5f5f5;
  border-radius: 4px;
}

.product-title {
  font-weight: bold;
  margin-bottom: 5px;
}

.pagination {
  display: flex;
  list-style: none;
  margin-top: 20px;
}

.pagination li {
  margin-right: 10px;
}

.pagination li a {
  text-decoration: none;
  color: #333;
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.pagination li.active a {
  background-color: #333;
  color: #fff;
}
</style>
