<template>
    <div>
      <h2>Users</h2>
      <div v-if="users.length > 0">
        <ul class="user-list">
          <li v-for="user in users" :key="user.id" class="user-item">
            <p class="username">Username: {{ user.name }}</p>
            <p class="email">Email: {{ user.email }}</p>
          </li>
        </ul>
      </div>
      <div v-else>
        <p>No users found.</p>
      </div>
    </div>
  </template>
  <script>
  export default {
    name: 'User',
    data() {
      return {
        users: [],
      };
    },
    created() {
      this.fetchUsers();
    },
    methods: {
      fetchUsers() {
        axios.get('/api/all-users')
          .then(response => {
            this.users = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
    },
  }
  </script>
  <style scoped>
  .user-list {
    list-style-type: none;
    padding: 0;
  }

  .user-item {
    background-color: #f0f0f0;
    padding: 10px;
    margin-bottom: 10px;
  }

  .username {
    font-weight: bold;
  }

  .email {
    color: gray;
  }
  </style>
