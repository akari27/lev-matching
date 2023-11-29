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
    <Head title="Mypage" />

    <AuthenticatedLayout>
        <!--<template #header>-->
        <!--    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mypage</h2>-->
        <!--</template>-->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pt-8 pb-8">
                    <p class="text-center font-bold text-3xl">マイページ</p>
                    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                        <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                            <div class="flex">
                                <div class="flex-1">
                                    <div class="grid justify-items-center">
                                        <div class="overflow-hidden rounded-full w-48 h-48">
                                            <img :src="user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'"  class="w-full h-full object-cover" />
                                        </div>
                                        <a :href="route('profile.edit')"><button>プロフィール編集</button></a>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="grid justify-items-center">
                                        <div class="text-base/7">
                                            <p class="font-bold text-2xl">{{ user.name }}</p>
                                            <div class="text-xl">
                                                <p>日本 {{ user.age }}歳 {{ user.gender_flag == 0 ? '男性' : '女性' }}</p>
                                                <p>居住地 : {{ props.user_data.register_location }}</p>
                                                <p>よく行く : {{ props.user_data.often_go_location }}</p>
                                                <p>趣味 : {{ props.user_data.hobby_category }}</p>
                                                <p>ヒトコト : {{ user.comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
