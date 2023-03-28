import { defineStore } from 'pinia'
// import axios from "axios";
import axiosInstance from "@/services/axiosService.js";
import {ElNotification} from "element-plus";
import router from "@/router/index.js";

export const useAuth = defineStore('auth', {
    state: () => ({
        user:{},
    }),
    persist: {
        paths: ["user"],
    },
    actions: {
        async login(fromData) {
            try {
                await axiosInstance.post("/user/login", fromData).then(response =>{
                    this.user=response.data;
                    ElNotification({
                        title: 'Success',
                        message: 'Login Success',
                        type: 'success',
                        position: 'top-left',
                    })
                    router.push({name:'index'});
                }).catch(e =>{
                    ElNotification({
                        title: 'Success',
                        message: e.response.data.errors.phone,
                        type: 'success',
                        position: 'top-left',
                    })
                });
            }catch (error){
                console.log(error)
            }
        },
    async logout(){
            try {
                const res=  await axiosInstance.post("/user/logout").then(response =>{
                    this.user=[];
                    ElNotification({
                        title: 'Success',
                        message: "Logout Success",
                        type: 'success',
                        position: 'top-left',
                    })
                    router.push({name:'index'});
                });
                console.log(res);
            }catch (error){

            }

    }
    },
})