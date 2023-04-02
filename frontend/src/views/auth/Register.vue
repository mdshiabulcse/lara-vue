<script setup>
import {useAuth} from "@/stores/auth.js";
import {storeToRefs} from "pinia";
import {reactive, ref} from "vue";
import { Field, Form } from 'vee-validate';
import * as yup from 'yup';
import { useRouter} from 'vue-router';
import { ElNotification } from 'element-plus';

const auth=useAuth();
const {errors}=storeToRefs(auth)

// const form=reactive({
//   phone:"",
//   password:"",
// });
const router=useRouter();
const showPassword=ref(false);
const toggleShow=()=>{
  showPassword.value = !showPassword.value
};
const onSubmit= async (values, {setErrors})=>{
  console.log(values)

  // const res= await auth.login(values);
  if (res.data){
    router.push({ name:'/' });
    ElNotification({
      title: 'Success',
      message: 'Login Success',
      type: 'success',
      position: 'top-left',
    })
  }else{
    setErrors(res);
  }
  //  console.log(actions);

};


const schema = yup.object({
  name: yup.string().required(),
  email: yup.string().required().email('Email Must be a valid Email!'),
  phone: yup.string().required('Phone field is required'),
  password: yup.string().required().min(8),
  password_confirmation: yup.string().required('Password Confirmation is a required field'),
});

</script>
<template>
  <div>
    <section class="user-form-part">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
            <div class="user-form-logo">
              <a href="index.html"><img src="@/assets/images/logo.png" alt="logo"/></a>
            </div>
            <div class="user-form-card">
              <div class="user-form-title">
                <h2>Customer Register</h2>
                <p>Create Your New Account</p>
              </div>
              <div class="user-form-group">
                <ul class="user-form-social">
                  <li>
                    <a href="#" class="facebook"
                    ><i class="fab fa-facebook-f"></i>Join with facebook</a
                    >
                  </li>
                  <li>
                    <a href="#" class="twitter"
                    ><i class="fab fa-twitter"></i>Join with twitter</a
                    >
                  </li>
                  <li>
                    <a href="#" class="google"
                    ><i class="fab fa-google"></i>Join with google</a
                    >
                  </li>
                  <li>
                    <a href="#" class="instagram"
                    ><i class="fab fa-instagram"></i>Join with instagram</a
                    >
                  </li>
                </ul>
                <div class="user-form-divider"><p>or</p></div>
                <Form class="user-form"  @submit="onSubmit" :validation-schema="schema" v-slot="{errors, isSubmitting}">
                  <div class="form-group">
                    <input
                        name="name"
                        type="text"
                        class="form-control"
                        placeholder="Enter your name"
                    />
                    <span class="text-danger" >{{errors.name}}</span>
                  </div>
                  <div class="form-group">
                    <Field
                        name="email"
                        type="email"
                        class="form-control"
                        placeholder="Enter your email"
                        :class="{'is-valid':errors.email}"
                    />
                    <span class="text-danger" >{{errors.email}}</span>
                  </div>
                  <div class="form-group">
                    <Field
                        name="phone"
                        type="text"
                        class="form-control"
                        placeholder="Enter your email"
                        :class="{'is-valid':errors.phone}"
                    />
                    <span class="text-danger" >{{errors.phone}}</span>
                  </div>
                  <div class="form-group">
                    <Field
                        name="password"
                        :type="showPassword ? 'text':'password'"
                        class="form-control"
                        placeholder="password"
                        :class="{'is-invalid':errors.password}"
                    />
                    <span class="text-danger" >{{errors.password}}</span>
                    <span class="view-password" @click="toggleShow"
                    ><i class="fas text-success fa-eye"
                        :class="{
                      'fa-eye-slash':showPassword,
                      'fa-eye':!showPassword,
                    }"
                    ></i></span
                    ><!--v-if-->
                  </div>
                  <div class="form-group">
                    <Field
                        name="password_confirmation"
                        :type="showPassword ? 'text':'password'"
                        class="form-control"
                        placeholder="Password Confirm"
                        :class="{'is-invalid':errors.password_confirmation}"
                    />
                    <span class="text-danger" >{{errors.password_confirmation}}</span>
                    <span class="view-password" @click="toggleShow"
                    ><i class="fas text-success fa-eye"
                        :class="{
                      'fa-eye-slash':showPassword,
                      'fa-eye':!showPassword,
                    }"
                    ></i></span
                    ><!--v-if-->
                  </div>
<!--                  <div class="form-check mb-3">-->
<!--                    <input-->
<!--                        class="form-check-input"-->
<!--                        type="checkbox"-->
<!--                        value=""-->
<!--                        id="check"-->
<!--                    /><label class="form-check-label" for="check"-->
<!--                  >Accept all the <a href="#">Terms & Conditions</a></label-->
<!--                  >-->
<!--                  </div>-->
                  <div class="form-button">
                    <button type="submit" :disabled="isSubmitting">Register <span v-show="isSubmitting" class="spinner-border spinner-border-sm mr-1"></span></button>
                  </div>
                </Form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>Already Have An Account?
                <router-link :to="{name:'user.login'}" href="login.html">login here</router-link>
              </p>
            </div>
            <div class="user-form-footer">
              <p>Greeny | &COPY; Copyright by <a href="#">W3 Coders</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<style>
@import "@/assets/css/user-auth.css";
</style>