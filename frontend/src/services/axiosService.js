import axios from "axios";
import {useAuth} from "@/stores";
import {storeToRefs} from "pinia";


const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL+"/api/v1",

});

axiosInstance.interceptors.request.use(function (config) {
    const authInfo =useAuth();
    // console.log("+++++++++++++++")
    // console.log(authInfo.user.meta.token)
    // console.log("+++++++++++++++")
    // const auth=authInfo.user.meta ? `Bearer ${authInfo.user.meta.token}`:"";
    // config.headers.common['Authorization'] = auth;

    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});



export default axiosInstance;