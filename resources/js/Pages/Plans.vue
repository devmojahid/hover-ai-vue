<script setup>
defineProps({ plans: Object });
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
const loading = ref(false);
const planId = ref('');
const submitSubscription = async () => {
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

        const response = await axios.post('/subscription/checkout', {
            data: planId.value
        });
    } catch (error) {
        console.error(error);
    }

    console.log(planId.value);
}

</script>

<template>

    <Head title="Subcription Plans" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="container">
            <form @submit.prevent="submitSubscription">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow" v-for="plan in  plans " :key="plan.id">
                        <div class="card-header">
                            {{ plan.id }}
                            <h4 class="my-0 font-weight-normal">{{ plan.name }}</h4>
                        </div>
                        <h1 class="mt-2">${{ plan.stripe_price }}
                            <small class="text-muted">/
                                {{ plan.interval }}
                            </small>
                        </h1>
                        <input type="text" hidden :data-plan-id="plan.id" v-model="planId">
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Free Credit 5</li>
                                <li>Number Of Credit <span>{{ plan.credits }}</span></li>
                            </ul>
                            <!-- <Link :href="route('subscription.subscribe', plan.stripe_product_id)
                    " method="post" class="btn btn-lg btn-block btn-outline-primary">
                            Subscribe</Link> -->
                            <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Subscribe</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>