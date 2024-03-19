<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInputWithIcon from '@/Components/TextInputWithIcon.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form> -->

        <div class="card-body">
            <p class="login-box-msg">Register a user</p>

            <form @submit.prevent="submit" method="post" class="mb-2 auth_form">
                <TextInputWithIcon typeHear="text" classHear="form-control" placeholderHear="Name" v-model="form.name"
                    :requiredHear="true" iconHear="fas fa-user">
                    <InputError class="mt-2" :message="form.errors.name" />
                </TextInputWithIcon>

                <TextInputWithIcon typeHear="email" classHear="form-control" placeholderHear="Email"
                    v-model="form.email" :requiredHear="true" iconHear="fas fa-envelope">
                    <InputError class="mt-2" :message="form.errors.email" />
                </TextInputWithIcon>

                <TextInputWithIcon typeHear="password" classHear="form-control" placeholderHear="Password"
                    v-model="form.password" :requiredHear="true" iconHear="fas fa-lock">
                    <InputError class="mt-2" :message="form.errors.password" />
                </TextInputWithIcon>

                <TextInputWithIcon typeHear="password" classHear="form-control" placeholderHear="Confirm Password"
                    v-model="form.password_confirmation" :requiredHear="true" iconHear="fas fa-lock">
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </TextInputWithIcon>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-block auth_form_btn">Register</button>
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-between">
                <Link :href="route('login')" class="text-center auth_account_indecator">Already registered?</Link>
            </div>
        </div>
    </GuestLayout>
</template>
