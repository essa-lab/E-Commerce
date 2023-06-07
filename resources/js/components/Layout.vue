<template>
<header>
    <ul class="navbar">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/products">Products</router-link></li>
        <li><router-link to="/categories">Category</router-link></li>
        <li><router-link to="/cart">Cart</router-link></li>
        <li v-if="!isAuthenticated"><router-link to="/login">Login</router-link></li>
        <li v-if="isAuthenticated"><router-link to="/profile">Profile</router-link></li>

    </ul>
    <button v-if="isAuthenticated" @click="logout">Logout</button>
</header>

<main><slot></slot><router-view></router-view></main>

<footer class="footer">
    <div class="footer-content">
      <p>&copy; 2023 TEST</p>
      <nav class="footer-links">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <a href="#">Terms of Service</a>
        <a href="#">Privacy Policy</a>
      </nav>
    </div>
  </footer>
</template>
<script>
export default{
    name:'Layout',
    computed: {
    isAuthenticated() {
      const token = localStorage.getItem('token');
      console.log(localStorage.getItem('token'))
      return !!token; // Convert token presence to boolean
      },
    },
    method:{
        logout() {
            console.log("hello from logout")
      this.$api
        .post('/logout')
        .then(response => {
            console.log(response)
          localStorage.removeItem('token'); // Remove the token from storage
          window.location.href = '/';
        })
        .catch(error => {
            console.error(error);
        });
    },

    }
};

</script>

<style>
.navbar {
  list-style-type: none;
  margin: 0;
  padding: 0;
  background-color: #f2f2f2;
  display: flex;
  justify-content: center;
}

.navbar li {
  margin: 0 10px;
}

.navbar li a {
  display: block;
  padding: 10px 15px;
  text-decoration: none;
  color: #333;
  border-bottom: 2px solid transparent;
  transition: border-bottom-color 0.3s ease-in-out;
}

.navbar li a:hover {
  border-bottom-color: #007bff;
}
.footer {
  background-color: #f2f2f2;
  padding: 20px;
  text-align: center;
  color: #666;
}

.footer-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex-shrink: 0;
}

.footer p {
  margin-bottom: 10px;
}

.footer-links {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.footer-links a {
  margin: 5px;
  padding: 5px 10px;
  text-decoration: none;
  color: #666;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: background-color 0.3s ease-in-out;
}

.footer-links a:hover {
  background-color: #ddd;
}
</style>
