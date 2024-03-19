<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInputWithIcon from '@/Components/TextInputWithIcon.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="card-body">
            <p class="login-box-msg">Login a user</p>

            <form @submit.prevent="submit" method="post" class="mb-2 auth_form">
                <TextInputWithIcon typeHear="email" classHear="form-control" placeholderHear="Email"
                    v-model="form.email" :requiredHear="true" iconHear="fas fa-envelope">
                    <InputError class="mt-2" :message="form.errors.email" />
                </TextInputWithIcon>

                <TextInputWithIcon typeHear="password" classHear="form-control" placeholderHear="Password"
                    v-model="form.password" :requiredHear="true" iconHear="fas fa-lock">
                    <InputError class="mt-2" :message="form.errors.password" />
                </TextInputWithIcon>

                <div class="block mt-3 mb-2">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-block auth_form_btn">Login</button>
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-between">
                <Link href="/register" class="text-center auth_account_indecator">I don't have account</Link>
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="text-center auth_account_indecator">
                Forgot your password?
                </Link>
            </div>
        </div>
    </GuestLayout>
</template>
