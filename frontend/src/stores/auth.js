import { defineStore } from 'pinia'
import axios from "axios";
import axiosInstance from "@/services/axiosService.js";

export const useAuth = defineStore("auth", {
    state: () => ({
        user:{},
        // errors: {},
    }),
    persist:{
        paths:["user"],
    },
    actions: {
        async login(formData) {


            try {
                const  res = await axiosInstance.post(
                    "/user/login",
                    formData
                );
                if(res.status === 200){
                    // console.log(res.data);
                    console.log(res.data);
                    this.user=res.data;
                    return new Promise((resolve)=>{
                        resolve(res.data);
                    })
                }
            }catch (error){
                if (error.response.data){
                    // this.errors =error.response.data.errors;
                    return new Promise((reject)=>{
                        reject(error.response.data.errors);
                    })
                }

            }
        },
        async logout(){
            try {
                const  res = await axiosInstance.post(
                    "/user/logout",
                    formData
                );
            }catch (error){

            }
        },
    },
})