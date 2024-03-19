<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Navbar from '@/Components/Partial/Navbar.vue';
import Sidebar from '@/Components/Partial/Sidebar.vue';
import Footer from '@/Components/Partial/Footer.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="wrapper">
        <Navbar />
        <sidebar />

        <div class="content-wrapper custom-content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="h-16"></div>
                    <slot />
                </div>
            </section>
        </div>
        <Footer />
    </div>
</template>
