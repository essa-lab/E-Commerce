<template>
    <div>
      <sidebar></sidebar>
      <div class="main-content">
        <router-view></router-view>
      </div>
    </div>
  </template>

  <script>
  import sidebar from './sidebar.vue'

  export default {
    name: 'Dashboard',
    components: {
     sidebar,
    },
  }
  </script>

  <style scoped>

  </style>
