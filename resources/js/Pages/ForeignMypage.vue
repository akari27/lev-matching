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
    <Head title="ForeignMypage" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-8">
                <p class="text-center font-bold text-3xl text-[#006f89]">マイページ</p>
                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg my-8">
                        <div class="flex">
                            <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                <div class="grid justify-items-center">
                                    <div class="overflow-hidden rounded-full w-32 h-32">
                                        <img :src="user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'"  class="w-full h-full object-cover bg-white" />
                                    </div>
                                    <a :href="route('foreign.profile.edit')" class="rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-28 mt-4"><button>編集する</button></a>
                                </div>
                            </div>
                            
                            <div class="flex basis-2/3 p-8">
                                <div class="grid justify-items-center">
                                    <div class="text-base/7 text-[#004758]">
                                        <span class="font-bold text-2xl">{{ user.name }}</span>
                                        <span class="text-lg ml-2">
                                            {{ user_data.register_location }}
                                            {{ user.age }}歳
                                            {{ user.gender_flag == 0 ? '男性' : '女性' }}
                                        </span>
                                        <div class="text-lg">
                                            <div class="mt-4">
                                                <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">滞在期間</span>
                                                <span class="font-bold text-xl pl-4">{{ user_data.start_of_stay }} ~ {{ user_data.end_of_stay }}</span>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪問場所</span>
                                                <span class="font-bold text-xl pl-4">{{ user_data.stay_location }}</span>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">趣味</span>
                                                <span class="font-bold text-xl pl-4">{{ user_data.hobby_category }}</span>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">ヒトコト</p>
                                                <p class="font-bold text-xl pl-4">{{ user.comment }}</p>
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
    </div>
</template>
