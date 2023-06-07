<template>
<div v-if="product" class="product-page">
    <div class="product-container">
      <div class="product-image">
        <img :src="product.image" :alt="product.title" />
      </div>
      <div class="product-details">
        <h1 class="product-title">{{ product.title }}</h1>
        <p class="product-description">{{ product.description }}</p>
        <p class="product-price">{{ product.price }}</p>
        <div class="rating-container">
          <span class="rating">{{product.rating.rate}}</span>
          <span class="votes">{{product.rating.count}} Votes</span>
        </div>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
    </div>
</div>

</template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        product: null,
      };
    },
    mounted() {
      this.fetchProduct();
    },
    methods: {
      fetchProduct() {
        const productId = this.$route.params.productId;
        console.log(productId)
        const url = `/api/products/${productId}`;

        axios.get(url)
          .then(response => {
            this.product = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
    },
  };
  </script>
  <style>
  .product-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.product-container {
  display: flex;
  flex-direction: row;
  align-items: center;
  border: 1px solid #ccc;
  padding: 20px;
}

.product-image {
  width: 200px;
  height: 200px;
  margin-right: 20px;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.product-details {
  flex: 1;
}

.product-title {
  font-size: 24px;
  margin-bottom: 10px;
}

.product-description {
  margin-bottom: 10px;
}

.product-price {
  font-size: 18px;
  margin-bottom: 10px;
}

.add-to-cart-btn {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.add-to-cart-btn:hover {
  background-color: #0056b3;
}
.rating-container {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.rating {
  font-size: 18px;
  font-weight: bold;
  margin-right: 5px;
}

.votes {
  font-size: 14px;
  color: #777;
}

</style>

