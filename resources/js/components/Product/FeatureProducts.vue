<template>
    <div>
      <h2>Featured Products</h2>
      <div class="product-list">
        <products v-for="product in featuredProducts" :key="product.id" :product="product"></products>
      </div>
    </div>
  </template>

<script>
import products from './products.vue'
export default {
    components: {
    products
  },
  data() {
    return {
        featuredProducts: [],
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {

      axios
        .get(`/api/featuredproducts`)
        .then(response => {
            this.featuredProducts = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }

};

</script>
