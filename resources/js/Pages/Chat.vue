<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    user_data: Object,
});

const user = usePage().props.auth.user;

</script>

<template>
    <Head title="Chat" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-8">
                <p class="text-center font-bold text-3xl text-[#006f89]">チャット</p>
                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                    チャット画面です。
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
