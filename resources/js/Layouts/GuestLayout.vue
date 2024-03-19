<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="hold-transition register-page">
        <div class="register-box">
            <div class="card">
                <div class="card-header text-center">
                    <Link href="/" class="flex items-center justify-center">
                    <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
