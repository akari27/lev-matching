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
                        <p class="text-center font-bold text-2xl pt-8 text-[#006f89]">〜繋がったユーザ〜</p>
                        <div v-if="props.approvedApplications.length!=0">
                            <p class="text-center text-xl pt-4 text-[#006f89]">チャット相手を選択してください。</p>
                            <div v-for="user in props.approvedApplications">
                                <a :href="'/chat/' + user.add_info.id">
                                    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                                        <div class="bg-white overflow-hidden shadow-md rounded-lg my-6">
                                            <div class="flex">
                                                <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                                    <div class="grid justify-items-center">
                                                        <div class="overflow-hidden rounded-full w-20 h-20">
                                                            <img :src="user.add_info.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex basis-2/3 p-8">
                                                    <div class="grid justify-items-center">
                                                        <div class="text-base/7 text-[#004758]">
                                                            <span class="font-bold text-2xl">{{ user.add_info.name }}</span>
                                                            <span class="text-lg ml-2">
                                                                {{ user.register_location }}
                                                                {{ user.add_info.age }} 歳
                                                                {{ user.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-center font-bold text-xl pt-4 text-[#e35748]">繋がったユーザはいません。マッチング相手を探そう！。</p>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>