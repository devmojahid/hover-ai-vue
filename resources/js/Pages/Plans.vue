<script setup>
defineProps({ plans: Object });
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Subcription Plans" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="container">
            <div class="card-deck mb-3 text-center">

                <div class="card mb-4 box-shadow" v-for="plan in    plans   ">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{ plan.name }}</h4>
                    </div>
                    <h1 class="mt-2">${{ plan.stripe_price }}
                        <small class="text-muted">/
                            {{ plan.interval }}
                        </small>
                    </h1>
                    <div class="card-body">

                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Free Credit 5</li>
                            <li>Number Of Credit <span>{{ plan.credits }}</span></li>
                        </ul>
                        <Link :href="route('subscription.subscribe', plan.stripe_product_id)
                    " method="post" class="btn btn-lg btn-block btn-outline-primary">
                        Subscribe</Link>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>