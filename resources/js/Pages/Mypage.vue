<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});

</script>

<template>
    <Head title="Mypage" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-8">
                <p class="text-center font-bold text-3xl text-[#006f89]">マイページ</p>
                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">

                <div v-if="!props.user.register_location || !props.user.often_go_location || !props.user.comment" class="pt-6">
                    <p class="text-center font-bold text-1xl text-[#e35748]">未登録の項目があります！今すぐ登録しましょう</p>
                </div>
                    
                    <div class="bg-white overflow-hidden shadow-md rounded-lg my-8">
                        <div class="flex">
                            <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                <div class="grid justify-items-center">
                                    <div class="overflow-hidden rounded-full w-32 h-32">
                                        <img :src="props.user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'"  class="w-full h-full object-cover bg-white" />
                                    </div>
                                    <a :href="route('profile.edit')" class="font-bold rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-28 mt-4"><button>編集する</button></a>
                                </div>
                            </div>
                            <div class="flex basis-2/3 px-10 py-6">
                                <div class="text-[#004758] text-base/7 flex flex-col w-full">
                                    <div class="p-2 border-b border-[#006f89]">
                                        <span class="font-bold text-2xl">{{ props.user.name }}</span>
                                        <span class="text-lg ml-2">
                                            日本
                                            {{ props.user.age }}歳
                                            {{ props.user.gender_flag == 0 ? '男性' : '女性' }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="text-base mx-2 w-full">
                                            <div class="mt-4 flex">
                                                <p class="w-1/5 font-bold text-[#6c8489]">居住地</p>
                                                <p class="w-4/5 ml-2">{{ props.user.register_location }}</p>
                                            </div>
                                            <div class="mt-2 flex">
                                                <p class="w-1/5 font-bold text-[#6c8489]">よく行く</p>
                                                <p class="w-4/5 ml-2">{{ props.user.often_go_location }}</p>
                                            </div>
                                            <div class="mt-2 flex">
                                                <p class="w-1/5 font-bold text-[#6c8489]">趣味</p>
                                                <p class="w-4/5 ml-2">{{ props.user.hobby_category }}</p>
                                            </div>
                                            <div class="mt-2 flex">
                                                <p class="w-1/5 font-bold text-[#6c8489]">ヒトコト</p>
                                                <p class="w-4/5 ml-2">{{ props.user.comment ? props.user.comment : '未登録' }}</p>
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
