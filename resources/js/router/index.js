import { createRouter, createWebHistory } from 'vue-router';
import HomeView from "../Pages/HomeView.vue";
import AboutView from "../Pages/AboutView.vue";
import RegisterView from "../Pages/RegisterView.vue";
import LoginView from "../Pages/LoginView.vue";
import CarView from "../Pages/CarView.vue";
import LogoutView from "../Pages/LogoutView.vue";
import ExploreView from "../Pages/ExploreView.vue";
import NewCarView from "../Pages/NewCarView.vue";
import UserView from "../Pages/UserView.vue";

// Create a router instance
const router = createRouter({
    // Use HTML5 history mode
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: HomeView // Home page route
        },
        {
            path: '/about',
            component: AboutView // About page route
        },
        {
            path: '/register',
            component: RegisterView // User registration route
        },
        {
            path: '/login',
            component: LoginView // User login route
        },
        {
            path: '/logout',
            component: LogoutView // User logout route
        },
        {
            path: '/explore',
            component: ExploreView // Explore page route
        },
        {
            path: '/users/:user_id',
            name: 'UserView',
            component: UserView, // User profile route
            props: true // Pass route parameters as props
        },
        {
            path: '/cars/new',
            component: NewCarView // Add new car route
        },
        {
            path: '/cars/:car_id',
            name: 'CarView',
            component: CarView, // Car details route
            props: true // Pass route parameters as props
        }
    ]
});

// Export the router instance
export default router;
