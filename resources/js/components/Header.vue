<script setup>
  import { ref, onMounted, onUnmounted } from 'vue';

  const isLoggedIn = ref(!!localStorage.getItem('token')); 
  const userId = ref(localStorage.getItem('user_id'));
  // // const token = ref(localStorage.getItem('token'));

  function updateUserId() {
    userId.value = localStorage.getItem('user_id');
  }

  // function updateToken() {
  //   token.value = localStorage.getItem('token');
  // }
  

  onMounted(() => {
    window.addEventListener('storage', updateUserId);
    // window.addEventListener('storage', updateToken);
  });

  // onUnmounted(() => {
  //   window.removeEventListener('storage', updateUserId);
  //  // window.removeEventListener('storage', updateToken);
  // });

</script>
<template>
  <head>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  </head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <!-- Car icon and United Auto Car Sales -->
        <a class="navbar-brand d-flex align-items-center" href="#">
          <!-- Car Icon -->
          <i class="fas fa-car me-2"></i> United Auto Sales
        </a>
  
        <!-- Toggler button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul v-if="!isLoggedIn" class="navbar-nav ms-auto mb-2 mb-lg-0">
            <!-- Register and Login links -->
            <li class="nav-item">
              <RouterLink class="nav-link" :class="{ active: $route.path === '/register'}" to="/register">Register</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" :class="{ active: $route.path === '/login'}" to="/login">Login</RouterLink>
            </li>
  
            <!-- Add car, Explore, and My profile links (visible only when logged in) -->
            
          </ul>
          <ul v-else class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" :class="{ active: $route.path === '/cars/new'}" to="/cars/new">Add Car</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" :class="{ active: $route.path === '/explore'}" to="/explore">Explore</RouterLink>
            </li>
            <li v-if="userId" class="nav-item">
              <RouterLink class="nav-link" :to="{ name: 'UserView', params: { user_id: userId }}">My Profile</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" :class="{ active: $route.path === '/about'}" to="/about">About</RouterLink>
            </li>
  
            <!-- Logout button (visible only when logged in) -->
            <li class="nav-item">
              <RouterLink class="nav-link btn-outline-light" :class="{ active: $route.path === '/logout'}"  to="/logout">Logout</RouterLink>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </template>
  
  
  <style scoped>
  /* Add any custom styles here */
  </style>
  
  <!-- Include Font Awesome library -->
  <link href='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'>  