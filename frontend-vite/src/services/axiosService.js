import axios from "axios";
import {useAuth} from "@/stores/index.js";
import {storeToRefs} from "pinia";
import router from "@/router/index.js";

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL+"/api/v1",
    headers: {
        "Content-Type": "application/json"
    }
});

axiosInstance.interceptors.request.use(config => {
    const authInfo=useAuth();
    if (authInfo.user?.meta?.token) {
        config.headers.Authorization = "Bearer " + authInfo.user.meta.token;
    }

    return config;
}, error => {
    // Do something with request error
    return Promise.reject(error);
});

axiosInstance.interceptors.response.use(
    response => {
        return response;
    },
    async error => {
        if (error.response.status === 401) {
            const authInfo=useAuth();
            authInfo.user = []
            router.push({name:"user.login"})
        }
        return Promise.reject(error);
    }
);

export default axiosInstance;