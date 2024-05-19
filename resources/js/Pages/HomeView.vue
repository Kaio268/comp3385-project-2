<script setup>
// Import the graduation image
import GraduationCar from '../../images/graduation.png';
</script>

<template>
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-start">
        <!-- Page title and description -->
        <h1 class="display-5 fw-bold">Buy and Sell Cars Online</h1>
        <p class="lead mb-4">
          United Auto Sales provides the fastest, easiest and most user-friendly way to buy or sell cars online. Find a Great Price on the Vehicle You Want.
        </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <!-- Navigation buttons for registration and login -->
          <router-link to="/register" class="btn btn-primary btn-lg px-4 me-md-2">Register</router-link>
          <router-link to="/login" class="btn reg-btn btn-lg px-4">Login</router-link>
        </div>
      </div>
      <div class="col-md-6">
        <!-- Display the GraduationCar image -->
        <img class="img-fluid" :src="GraduationCar" alt="Graduation Themed Car" />
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Custom button style */
.reg-btn {
  background-color: #02bd88;
  color: white;
}
</style>
