<script setup>
import { ref, computed } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const fileInput = ref(null);
const isFileAttached = ref(false);

const registrationSuccess = ref(false);
const userData = ref({
    name: '',
    password: '',
    email: '',
    location: '',
    biography: ''
});

const passwordError = computed(() => {
    if (userData.value.password.length < 6) {
        return 'Password must be at least 6 characters long';
    } else {
        return '';
    }
});

const emailError = computed(() => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(userData.value.email)) {
        return 'Invalid email format';
    } else {
        return '';
    }
});

const emailTakenError = ref('');

const registerUser = () => {
    // emailTakenError.value = ''; // Reset emailTakenError before registration
    // if (!userData.value.name.trim() || !userData.value.biography.trim() || !userData.value.location.trim() || !isFileAttached.value || passwordError.value || emailError.value) {
    //     return; // Don't proceed with registration if there are errors
    // }

    let registerForm = document.getElementById('registerForm');
    let form_data = new FormData(registerForm);

    // Append user data to form_data
    // Object.entries(userData.value).forEach(([key, value]) => {
    //     form_data.append(key, value);
    // });

    fetch("/api/v1/auth/register", {
        method: 'POST',
        body: form_data,
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response =>{
        return response.json();
    })
    .then(data => {
        registrationSuccess.value = true; // Show success message
        setTimeout(() => {
            registrationSuccess.value = false; // Hide success message
            
        }, 2000); // Delay in milliseconds
        registerForm.reset(); // Reset the form
        router.push({path: '/login'});
    })
    .catch(error => {
        console.error(error);
    });
};

const handleFileChange = () => {
    const files = fileInput.value.files;
    isFileAttached.value = files.length > 0;
};


</script>


<template>
    <h1>Register New User</h1>
    <form class="row g-3" @submit.prevent="registerUser" id="registerForm" action="" enctype="multipart/form-data" method="post">

        <!-- Full Name -->
        <div class="mb-3 col-md-6">
            <label for="name" class="form-label fw-bold">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" v-model="userData.name">
            <p class="text-danger" v-if="!userData.name.trim()">Name is required</p>
        </div>

        <!-- Password -->
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password" name="password" id="password" class="form-control" v-model="userData.password">
            <p class="text-danger" v-if="passwordError">{{ passwordError }}</p>
        </div>

        <!-- Email -->
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" name="email" id="email" class="form-control" v-model="userData.email" @blur="checkEmail">
            <p class="text-danger" v-if="emailError">{{ emailError }}</p>
        </div>

        <!-- Location -->
        <div class="col-md-6 mb-3">
            <label for="location" class="form-label fw-bold">Location</label>
            <input type="text" name="location" id="location" class="form-control" v-model="userData.location">
            <p class="text-danger" v-if="!userData.location.trim()">Location is required</p>
        </div>

        <!-- Biography -->
        <div class="col-md-12 mb-3">
            <label for="biography" class="form-label fw-bold">Biography</label>
            <textarea name="biography" id="biography" cols="30" rows="5" class="form-control" v-model="userData.biography"></textarea>
            <p class="text-danger" v-if="!userData.biography.trim()">Biography is required</p>
        </div>

        <!-- Photo -->
        <div class="col-md-12 mb-3">
            <label for="photo" class="form-label fw-bold d-block">Photo</label>
            <label for="photo" class="btn btn-outline-secondary">
                Browse
                <input class="form-control d-none" type="file" name="photo" id="photo" ref="fileInput" >
            </label>
            <!-- <p v-if="isFileAttached">File attached!</p>
            <p class="text-danger" v-if="!isFileAttached">Photo is required</p> -->
        </div>

        <!-- Register Button -->
        <div class="mb-3">
            <button type="submit" class="btn reg-btn">Register</button>
        </div>

        <!-- Success message -->
        <p v-if="registrationSuccess" class="text-success">Registration successful!</p>
    </form>

    <!-- Bootstrap Toast for email taken error -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" :class="{ 'show': emailTakenError !== '' }">
        <div class="toast-header">
            <strong class="me-auto">Error</strong>
            <button type="button" class="btn-close" @click="emailTakenError = ''"></button>
        </div>
        <div class="toast-body">
            {{ emailTakenError }}
        </div>
    </div>
</template>

<style>
    .reg-btn {
        background-color: #02bd88;
        color: white;
    }
</style>
