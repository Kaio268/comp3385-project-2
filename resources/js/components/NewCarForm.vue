<script setup>

import {ref} from 'vue';
import {useRouter} from 'vue-router';

const router = useRouter();
const errorMessage = ref ('');



//ADD A NEW CAR
const AddNewCar = () => {
    let newCarForm = document.getElementById('NewCarForm');
    let form_data = new FormData(newCarForm);

    fetch("/api/v1/cars", {
        method: "POST",
        body: form_data,
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
    .then(response => {
        if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
        return response.json(); 
    })
    .then(data => {
        newCarForm.reset(); // Reset the form
        router.push('/explore');
    })
    .catch(error => {
        errorMessage.value = error.message; // Update the error message
        console.error("Failed to add car:", error.message);
    });
}
</script>

<template>
    <h1>Add New Car</h1>
    <form class="row g-3" @submit.prevent="AddNewCar" id="NewCarForm" action="" enctype="multipart/form-data" method="post">

        <div class="mb-3 col-md-6">
            <label for="make" class="form-label fw-bold">Make</label>
            <input type="text" name="make" id="make" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="model" class="form-label fw-bold">Model</label>
            <input type="text" name="model" id="model" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="colour" class="form-label fw-bold">Colour</label>
            <input type="text" name="colour" id="colour" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="year" class="form-label fw-bold">Year</label>
            <input type="text" name="year" id="year" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="price" class="form-label fw-bold">Price</label>
            <input type="text" name="price" id="price" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="car_type" class="form-label fw-bold">Car Type</label>
            <select  name="car_type" id="car_type" class="form-select">
                <option value="Suv">SUV</option>
                <option value="Pickup Truck">Pickup Truck</option>  
                <option value="Station Wagon">Station Wagon</option>  
                <option value="Hatchback">Hatchback</option>  
                <option value="Sedan">Sedan</option>  
                <option value="Coupe">Coupe</option>  
                <option value="Sports Car">Sports Car</option>  
                <option value="Convertible">Convertible</option>  
                <option value="Minivan">Minivan</option>  
                <option value="Van">Van</option>  
                <option value="Crossover">Crossover</option>  
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="transmission" class="form-label fw-bold">Transmission</label>
            <select type="text" name="transmission" id="transmission" class="form-select">
                <option value="Automatic">Automatic</option>
                <option value="Manual">Manual</option>
                <option value="CVT">CVT</option>
                <option value="EV">EV</option>
            </select>
        </div>

        <div >
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea type="text" name="description" id="description" rows="5" class="form-control">  </textarea>
        </div>

        <div class="col-md-12 mb-3">
            <label for="photo" class="form-label fw-bold d-block " >Upload Photo</label>
            <label for="photo" class="btn btn-outline-secondary" style="width: 100px;">
                Browse
                <input class="form-control d-none" type="file" name="photo" id="photo">
            </label>
            <span id="file-chosen" class="ms-4">No File Selected</span>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success" style="width: 150px; background-color:#15ad87;">Save</button>
        </div>
    </form>
</template>

<style>
</style>