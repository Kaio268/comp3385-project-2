<script setup>
import { useRouter } from "vue-router";
const router = useRouter();

    function Login() {
        let loginForm = document.getElementById('loginForm');
        let form_data = new FormData(loginForm);

        fetch("/api/v1/auth/login", {
            method: "POST",
            body: form_data,
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(async response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(function (data) {
            localStorage.setItem('token', data.access_token);
            localStorage.setItem('user_id', data.user_id);
            loginForm.reset();
            router.push({path: '/explore'});
        })
        .catch(function (error) {
            console.log(error);
        })
    }
</script>

<template>
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form @submit.prevent="Login" id="loginForm" action="" method="post">
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="johndoe@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn login-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</template>

<style scoped>
    .login-btn {
        background-color: #02bd88;
        color: white;
    }
</style>