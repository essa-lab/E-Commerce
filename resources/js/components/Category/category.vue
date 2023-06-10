
<template>
    <div class="category">
      <h2 class="category-title">Feature Category</h2>
      <ul class="category-list">
        <li v-for="item in allCategories" :key="item.id" class="category-item">
          <router-link :to="`/category-products/${item.id}`" class="category-link">{{ item.title }}</router-link>
        </li>
      </ul>
    </div>
  </template>

<script>

import Layout from '../Layout.vue';

import axios from "axios";

export default {
    name: 'category',
  components: {
    Layout,
  },
    data() {
        return {
            allCategories: [],

        };
    },

    mounted() {
        this.fetchCategories();
    },
    methods: {

        fetchCategories() {
            axios
                .get("http://127.0.0.1:8000/api/categories")
                .then((response) => {
                    this.allCategories = response.data.data;
                })
                .catch((error) => {
                    console.error( error);
                });
        },

    },
};
</script>
<style>
.category {
  margin-bottom: 20px;
}

.category-title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.category-list {
  list-style-type: none;
  padding: 0;
}

.category-item {
  margin-bottom: 5px;
}

.category-link {
  display: inline-block;
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  text-decoration: none;
  color: #333;
  transition: background-color 0.3s ease-in-out;
}

.category-link:hover {
  background-color: #f2f2f2;
}
</style>
