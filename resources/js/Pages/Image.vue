<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3'
const loading = ref(false);
const imageGenaretion = reactive({
    prompt: '',
    data1: '',
    data2: '',
    data3: '',
});
const responseConvertion = ref('');
const submit = async () => {
    try {
        axios.interceptors.request.use((config) => {
            loading.value = true;
            return config;
        }, (error) => {
            loading.value = false;
            return Promise.reject(error);
        });

        axios.interceptors.response.use((response) => {
            loading.value = false;
            return response;
        }, (error) => {
            loading.value = false;
            return Promise.reject(error);
        });

        const response = await axios.post('/image-generation', {
            data: imageGenaretion.prompt
        });
        console.log(response);

    } catch (error) {
        console.error(error);
    }
}
</script>

<template>

    <Head title="Image" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Image</h2>
        </template>
        <div class="main main-conversation-msg">
            <section class="msger">
                <header class="msger-header">
                    <div class="msger-header-title">
                        <i class="fas fa-image"></i> Image Genaretion
                    </div>
                </header>
                <form @submit.prevent="submit">
                    <div class="msger-inputarea">
                        <input type="text" class="msger-input" placeholder="Enter your message..."
                            v-model="imageGenaretion.prompt">
                        <button type="submit" class="msger-send-btn">Send</button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group
                            ">
                                    <label for="exampleInputEmail1">Width</label>
                                    <input type="email" class="form-control msger-input" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email"
                                        v-model="imageGenaretion.data1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group
                            ">
                                    <label for="exampleInputPassword1">Height</label>
                                    <input type="password" class="form-control msger-input" id="exampleInputPassword1"
                                        placeholder="Password" v-model="imageGenaretion.data2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group
                            ">
                                    <label for="exampleFormControlSelect1">Select Image Type</label>
                                    <select class="form-control msger-input" id="exampleFormControlSelect1"
                                        v-model="imageGenaretion.data3">
                                        <option>jpg</option>
                                        <option>png</option>
                                        <option>gif</option>
                                        <option>jpeg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <main class="msger-chat">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" class="card-img-top"
                                    alt="..." height="200px" width="200px">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg"
                                    class="card-img-top" alt="..." height="200px" width="200px">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://fakestoreapi.com/img/71YXzeOuslL._AC_UY879_.jpg" class="card-img-top"
                                    alt="..." height="200px" width="200px">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://fakestoreapi.com/img/71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg"
                                    class="card-img-top" alt="..." height="200px" width="200px">
                            </div>
                        </div>
                    </div>
                </main>
            </section>
        </div>
    </AuthenticatedLayout>
</template>