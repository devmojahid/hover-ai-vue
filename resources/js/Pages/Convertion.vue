<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3'
const loading = ref(false);
const convertiontext = ref('');
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

        const response = await axios.post('/convertion/convert', {
            data: convertiontext.value
        });
        responseConvertion.value = response.data;
        convertiontext.value = '';

    } catch (error) {
        console.error(error);
    }
}

</script>

<template>

    <Head title="Convertion" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Convertion</h2>
        </template>
        <div class="main main-conversation-msg">
            <section class="msger">
                <header class="msger-header">
                    <div class="msger-header-title">
                        <i class="fas fa-comment-alt"></i> Chat with Ai
                    </div>
                    <div class="msger-header-options">
                        <span><i class="fas fa-cog"></i></span>
                    </div>
                </header>

                <main class="msger-chat">
                    <div class="msg left-msg">
                        <div class="msg-img"
                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                        </div>

                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name">BOT</div>
                            </div>
                            <div v-if="loading" class="msg-text">
                                <div class="loader">
                                    <div class="loader-inner"></div>

                                    <div id="loading-bubble">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="msg-text" v-else>
                                {{ responseConvertion }}
                            </div>
                        </div>
                    </div>

                    <div class="msg right-msg">
                        <div class="msg-img"
                            style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                        </div>

                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name">Sajad</div>
                            </div>

                            <div class="msg-text">
                                {{ convertiontext }}
                            </div>
                        </div>
                    </div>
                </main>

                <form class="msger-inputarea" @submit.prevent="submit">
                    <input type="text" class="msger-input" placeholder="Enter your message..." v-model="convertiontext">
                    <button type="submit" class="msger-send-btn">Send</button>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>