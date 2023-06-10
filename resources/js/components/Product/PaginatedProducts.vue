<template>
    <div>
        <h2>All Products</h2>
      <div class="product-list">
        <products v-for="product in products" :key="product.id" :product="product"></products>
      </div>

      <nav>
        <ul class="pagination">
          <li v-for="page in pages" :key="page" @click="fetchProducts(page)">
            <a href="#">{{ page }}</a>
          </li>
        </ul>
      </nav>
    </div>
</template>

<script>
import products from './products.vue'

export default {
  data() {
    return {
      products: [],
      currentPage: 1,
      totalPages: 1,
      pages:[]
    };
  },
  components: {
    products
  },
  created() {
    this.fetchProducts(this.currentPage);
  },
  methods: {
    fetchProducts(page) {
      axios
        .get(`/api/pp?page=${page}`)
        .then(response => {
          this.products = response.data.data.data;
          this.currentPage = response.data.data.current_page;
          this.totalPages = response.data.data.last_page;
          this.generatePageNumbers();
        })
        .catch(error => {
          console.log(error);
        });
    },
    generatePageNumbers() {
      this.pages = Array.from({ length: this.totalPages }, (_, index) => index + 1);
    },
  }

};

</script>
<style>
.product-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  grid-gap: 1rem;
}

.pagination {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
  margin: 1rem 0;
}

.pagination li {
  margin: 0 0.5rem;
}

.pagination li a {
  padding: 0.5rem;
  text-decoration: none;
  color: #333;
}

.pagination li.active a {
  color: #fff;
  background-color: #333;
}
</style>
