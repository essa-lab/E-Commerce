<template>
    <div class="login-container">
      <h2>Login</h2>
      <form @submit.prevent="login" class="login-form">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <button type="submit">Login</button>
      </form>
      <router-link class="register-button" to="/register">Register</router-link>
    </div>
  </template>

  <script>
import { mapState} from 'vuex';
  export default {
    computed:{
        ...mapState(['user']),
    },
    data() {
      return {
        email: '',
        password: '',

      };
    },
    methods: {
      login() {
        this.$api
          .post('/login', {
            email: this.email,
            password: this.password,
          })
          .then(response => {
            this.$store.dispatch('login',[this.email])
            const token = response.data.data.token;
            localStorage.setItem('user',JSON.stringify(response.data.data));
            localStorage.setItem('token', token);
            window.location.href = '/';
          })
          .catch(error => {
            console.error(error);
          });
      },
    },
  };
  </script>
<style>
.login-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
}

input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}

button:hover {
  background-color: #45a049;
}

button:disabled {
  background-color: #ddd;
  cursor: not-allowed;
}

.register-button {
  background-color: #2196F3;
  color: #fff;
  padding: 0px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
  text-decoration: none;
}

.register-button:hover {
  background-color: #1976D2;
}
</style>
