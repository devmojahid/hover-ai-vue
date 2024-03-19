<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import SidebarLink from '@/Components/Partial/SidebarLink.vue';
</script>

<template>
    <aside class="main-sidebar main-sidebar-custom sidebar-light-primary main-sidebarcustom-class">
        <!-- Sidebar -->
        <a href="../../index3.html" class="brand-link">
            <img src="backend/images/logo/logo.svg" class="brand-image">
            <img src="backend/images/logo/logo-2.png" class="brand-image-2 d-none">
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <SidebarLink routepath="dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </SidebarLink>

                    <!-- Convertion-->
                    <SidebarLink routepath="convertion">
                        <i class="nav-icon fab fa-rocketchat"></i>
                        <p>
                            Converation
                        </p>
                    </SidebarLink>

                    <!-- Image Genaretion-->
                    <SidebarLink routepath="image">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Image Genaretion
                        </p>
                    </SidebarLink>

                    <!-- code Genaretion-->
                    <SidebarLink routepath="code">
                        <i class="nav-icon fas fa-code"></i>
                        <p>
                            Code Genaretion
                        </p>
                    </SidebarLink>

                    <!-- Email Genaretion -->
                    <SidebarLink routepath="email">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Email Genaretion
                        </p>
                    </SidebarLink>

                    <!-- subscription -->
                    <SidebarLink routepath="subscription.plans">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Subscription
                        </p>
                    </SidebarLink>

                    <!-- Setting-->
                    <SidebarLink routepath="setting">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                        </p>
                    </SidebarLink>
                </ul>
            </nav>
        </div>
    </aside>
</template>