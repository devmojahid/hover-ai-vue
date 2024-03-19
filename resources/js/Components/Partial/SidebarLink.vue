<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    routepath: String,
});
</script>

<template>
    <li class="nav-item">
        <Link :href="route(props.routepath)" class="nav-link" :class="{ 'active': route().current(props.routepath) }">
        <slot></slot>
        </Link>
    </li>
</template>