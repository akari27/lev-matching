<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    user_data: Object,
    approvedApplications: Array,
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
                    
                    <div>
                        <p>繋がったユーザー</p>
                        <div v-for="user in props.approvedApplications">
                            <a :href="'/chat/' + user.user_id">
                                <div class="flex bg-[#006f89] text-gray-50 mt-4">
                                    <p>{{ user.name }}</p>
                                    <div class="overflow-hidden rounded-full w-32 h-32">
                                        <img :src="user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
