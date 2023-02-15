import axios from "axios";
import {useAuth} from "@/stores/auth.js";


const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL+"/api/v1",
});

axiosInstance.interceptors.request.use(
    function (config) {
        const authInfo =useAuth();

        // const auth = authInfo.user.meta ? `Bearer ${authInfo.user.meta.token}`:"";
        console.log("auth")
        console.log(authInfo.user.meta)
        console.log("auth")
        // config.headers.common['Authorization'] = auth;
                return config;
}, function (error) {

    return Promise.reject(error);
});

export default axiosInstance;