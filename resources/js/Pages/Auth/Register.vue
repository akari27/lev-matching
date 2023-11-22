<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    is_japanese: '',
    gender_flag: '',
    age: '',
    hobby_category_id: '',
    terms: false,
});

defineProps({
    hobby_categories: Array
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

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            
            <div class="mt-4">
                <InputLabel for="is_japanese" value="Japanese or Foreign visitor to Japan?" />

                <select 
                    id="is_japanese"
                    class="mt-1 block w-full"
                    v-model="form.is_japanese"
                    required
                    autocomplete="is_japanese"
                >
                    <option value="1">Japanese</option>
                    <option value="0">Foreign visitor</option>
                </select>

                <InputError class="mt-2" :message="form.errors.is_japanese" />
            </div>
            
            <div class="mt-4">
                <InputLabel for="gender_flag" value="Gender" />

                <select 
                    id="gender_flag"
                    class="mt-1 block w-full"
                    v-model="form.gender_flag"
                    required
                    autocomplete="gender_flag"
                >
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>

                <InputError class="mt-2" :message="form.errors.gender_flag" />
            </div>
            
            <div class="mt-4">
                <InputLabel for="age" value="Age" />

                <TextInput
                    id="age"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.age"
                    required
                    autocomplete="age"
                />

                <InputError class="mt-2" :message="form.errors.age" />
            </div>
            
            <div class="mt-4">
                <InputLabel for="hobby_category_id" value="Hobby" />

                <select 
                    id="hobby_category_id"
                    class="mt-1 block w-full"
                    v-model="form.hobby_category_id"
                    required
                    autocomplete="hobby_category_id"
                >
                    <option v-for="hobby_category in hobby_categories" :value="hobby_category.id">{{ hobby_category.name }}</option>
                </select>

                <InputError class="mt-2" :message="form.errors.hobby_category_id" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
