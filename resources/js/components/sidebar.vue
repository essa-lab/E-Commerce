<template>
    <div class="sidebar">
      <ul>
        <li><router-link to="/dashboard/products" >Products</router-link></li>
        <li><router-link to="/dashboard/categories" >Categories</router-link></li>
        <li><router-link to="/dashboard/all-orders" >Orders</router-link></li>
        <li><router-link to="/dashboard/all-users" >Users</router-link></li>
      </ul>
    </div>
  </template>

  <style scoped>
  .sidebar {
    width: 200px;
    background-color: #f0f0f0;
    padding: 20px;
  }

  .sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .sidebar li {
    margin-bottom: 10px;
  }

  .sidebar a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s;
  }

  .sidebar a:hover {
    background-color: #ccc;
  }
  </style>
