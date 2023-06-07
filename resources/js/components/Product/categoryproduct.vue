<template>
    <div>
      <h2>Category Products</h2>
      <div class="product-list">
        <products v-for="product in cProducts" :key="product.id" :product="product"></products>
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
        cProducts: [],
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {

    fetchProducts() {

    const catId = this.$route.params.catId;
    const url = `api/category-products/${catId}`;

         axios
        .get(url)
        .then(response => {
            this.cProducts = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }

};

</script>

