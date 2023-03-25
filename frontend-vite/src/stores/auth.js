import { defineStore } from 'pinia'
import axios from "axios";
export const useAuth = defineStore('auth', {

    actions: {
        async login(fromData) {
            try {
                let res=  await axios.post(import.meta.env.VITE_API_URL+"/api/v1/user/login",
                    fromData
                );
                if(res.status === 200){
                    console.log(res.data)
                }
            }catch (error){
                console.log(error)
            }
        }

    }
})