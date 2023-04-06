<script setup>
import {useAuth} from "@/stores/auth.js";
import { ref} from "vue";
import {Field, Form} from 'vee-validate';
import * as yup from 'yup';
import {useRouter} from 'vue-router';
import {ElNotification} from 'element-plus';

const auth = useAuth();


const router = useRouter();
const showPassword = ref(false);

const toggleShow = () => {
    showPassword.value = !showPassword.value
};

const onSubmit = async (values, {setErrors}) => {
    const res = await auth.register(values);
    if (res.data) {
        router.push({name: '/'});
        ElNotification({
            title: 'Success',
            message: 'Register Success',
            type: 'success',
            position: 'top-left',
        })
    } else {
        setErrors(res);
    }

};


const schema = yup.object({
    name: yup.string().required(),
    email: yup.string().required().email('Email Must be a valid Email!'),
    phone: yup.string().required('Phone field is required'),
    password: yup.string().required().min(8),
    password_confirmation: yup.string().required('Password Confirmation is a required field')
        .oneOf([yup.ref("password"),null],"Password and Confirm Password must be match"),
});

</script>
<template>
    <div>
        <div>
            <section class="user-form-part">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-6">
                            <div class="user-form-card">
                                <div class="user-form-title">
                                    <h2>Customer Register</h2>
                                </div>
                                <div class="user-form-group" id="axiosForm">
                                    <Form class="user-form" @submit="onSubmit" :validation-schema="schema"
                                          v-slot="{errors, isSubmitting}">
                                        <!--v-if-->
                                        <div class="form-group">
                                            <Field
                                                    name="name"
                                                    type="text"
                                                    class="form-control "
                                                    placeholder="Name"
                                                    :class="{'is-invalid':errors.name}"

                                            /><!--v-if-->
                                            <span class="text-danger">{{ errors.name }}</span>
                                        </div>
                                        <div class="form-group">
                                            <Field
                                                    name="email"
                                                    type="email"
                                                    class="form-control "
                                                    placeholder="Email"
                                                    :class="{'is-invalid':errors.email}"

                                            /><!--v-if-->
                                            <span class="text-danger">{{ errors.email }}</span>
                                        </div>
                                        <div class="form-group">
                                            <Field
                                                    name="phone"
                                                    type="text"
                                                    class="form-control "
                                                    placeholder="phone no"
                                                    :class="{'is-invalid':errors.phone}"/>
                                            <span class="text-danger">{{ errors.phone }}</span>
                                        </div>
                                        <div class="form-group">
                                            <Field
                                                    name="password"
                                                    :type="showPassword ? 'text':'password'"
                                                    class="form-control"
                                                    placeholder="Password"
                                                    :class="{'is-invalid':errors.password}"
                                            />
                                            <span class="text-danger">{{ errors.password }}</span>
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
                                                    placeholder="Confirm Password"
                                                    :class="{'is-invalid':errors.password_confirmation}"
                                            />
                                            <span class="text-danger">{{ errors.password_confirmation }}</span>
                                            <span class="view-password" @click="toggleShow"
                                            ><i class="fas text-success fa-eye"
                                                :class="{
                                                      'fa-eye-slash':showPassword,
                                                      'fa-eye':!showPassword,
                                                    }"
                                            ></i></span
                                            ><!--v-if-->
                                        </div>
                                        <div class="form-button">
                                            <button type="submit" :disabled="isSubmitting">login<span
                                                    v-show="isSubmitting"
                                                    class="spinner-border spinner-border-sm mr-1"></span></button>
                                        </div>
                                    </Form>
                                </div>
                            </div>
                            <div class="user-form-remind">
                                <p>
                                    Don't have any account?
                                    <router-link :to="{name:'user.login'}" href="/auth/register" class=""
                                    >Login here
                                    </router-link
                                    >
                                </p>
                            </div>
                            <div class="user-form-footer"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<style>
@import "@/assets/css/user-auth.css";
</style>