<script setup>
import { ref, onMounted } from "vue";

// Reactive references for cars and filters
let cars = ref([]);
let allCars = ref([]);
let filterMake = ref("");
let filterModel = ref("");

// Fetch all cars from the server
function fetchCars() {
  fetch("/api/v1/cars", {
    method: 'GET',
    headers: {
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
      'Content-Type': 'application/json'
    }
  })
  .then((response) => response.json())
  .then((data) => {
    console.log(data);
    allCars.value = data.cars;
    cars.value = [...allCars.value];
  })
  .catch(function (error) {
    console.log(error);
  });
}

// Filter cars based on make and model
function searchCars() {
  cars.value = allCars.value.filter(car =>
    car.make.toLowerCase().includes(filterMake.value.toLowerCase()) &&
    car.model.toLowerCase().includes(filterModel.value.toLowerCase())
  );
}

// Fetch cars on component mount
onMounted(() => fetchCars());
</script>

<template>
  <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  </head>

  <div class="explore-view">
    <!-- Title -->
    <h1 class="title">Explore</h1>
    <br>
    <!-- Search Bar -->
    <div class="shadow-sm rounded-2">
      <div class="row ps-5 ms-5">
        <div class="mb-3 col-4">
          <label for="make">Make</label>
          <input type="text" class="form-control" id="make" v-model="filterMake" placeholder="Enter make">
        </div>
        <div class="mb-3 col-4">
          <label for="model">Model</label>
          <input type="text" class="form-control" id="model" v-model="filterModel" placeholder="Enter model">
        </div>
        <div class="mb-3 col-4">
          <br>
          <button class="search-button btn text-white" @click="searchCars">Search</button>
        </div>
      </div>
    </div>
    <!-- Car Listings -->
    <div class="container mt-5">
      <div class="row row-gap-4" id="cars-container">
        <div v-for="car in cars" :key="car.id" class="col-md-4">
          <div class="card">
            <img :src="car.photo" class="card-img-top" alt="Car Image">
            <div class="card-body">
              <div class="row">
                <h5 class="card-title col-6">{{ car.year }} {{ car.make }}</h5>
                <p class="card-text text-center rounded-3 w-50 text-white col-6 price-bg">
                  <i class="fas fa-tag"></i> {{ car.price }}
                </p>
              </div>
              <h5 class="text-secondary">{{ car.model }}</h5>
            </div>
            <div class="card-body text-center">
              <router-link :to="{ name: 'CarView', params: { car_id: car.id }}" class="btn btn-primary w-75">View more Details</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Title Style */
.title {
  font-weight: bold;
}
/* Search Bar Styles */
.search-bar {
  display: flex;
  align-items: center;
  margin-top: 20px;
}
.search-input {
  margin-right: 20px;
}
.search-button {
  background-color: #02bd88;
}
.price-bg {
  background-color: #02bd88;
}
/* Car Listings Styles */
.car-listings {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}
.car {
  width: calc(33.33% - 20px); /* Adjust width for responsiveness */
  margin-right: 20px;
  margin-bottom: 20px;
  background-color: #f2f2f2;
  padding: 20px;
}
.car img {
  width: 100%;
}
.car-details {
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
}
.car-name {
  font-weight: bold;
}
.car-price {
  background-color: #4caf50; /* Green */
  color: #fff;
  padding: 5px 10px;
  border-radius: 5px;
}
.view-details-button {
  margin-top: 10px;
  background-color: #2196F3; /* Blue */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>
