<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const props = defineProps({
    sendApplications: Array,
    recieveApplications: Array,
    approvedApplications: Array,
    users: Array,
});

const form = useForm({
    senderId: null,
})

function permission(id){
    form.senderId = id
    form.post(route('foreign.application.permission'))
}
function reject(id){
    form.senderId = id
    form.post(route('foreign.application.reject'))
}

</script>

<template>
    <Head title="Application" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-8">
                <p class="text-center font-bold text-3xl text-[#006f89]">申請リスト</p>
                <p class="text-center font-bold text-2xl pt-4 text-[#006f89]">〜申請済み〜</p>
                <p v-if="props.sendApplications.length==0" class="text-center font-bold text-1xl pt-4 text-[#e35748]">承認待ちの申請はありません。</p>
                <div v-else v-for="send in props.sendApplications" :key="send.id">
                    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                        
                        <div class="bg-white overflow-hidden shadow-md rounded-lg my-8">
                            <div class="flex">
                                <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                    <div class="grid justify-items-center">
                                        <div class="overflow-hidden rounded-full w-32 h-32">
                                            <img :src="send.add_info.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="w-full h-full object-cover bg-white" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex basis-2/3 px-10 py-6">
                                    <div class="text-[#004758] text-base/7 flex flex-col w-full">
                                        <div class="p-2 border-b border-[#006f89]">
                                            <span class="font-bold text-2xl">{{ send.add_info.name }}</span>
                                            <span class="text-lg ml-2">
                                                日本
                                                {{ send.add_info.age }} 歳
                                                {{ send.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-base mx-2 w-full">
                                                <div class="mt-4 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">居住地</p>
                                                    <p class="w-4/5 ml-2">{{ send.register_location ? send.register_location : '-' }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">よく行く</p>
                                                    <p class="w-4/5 ml-2">{{ send.often_go_location ? send.often_go_location : '-' }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">趣味</p>
                                                    <p class="w-4/5 ml-2">{{ send.hobby }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">ヒトコト</p>
                                                    <p class="w-4/5 ml-2">{{ send.add_info.comment ? send.add_info.comment : '-'}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <p class="text-center font-bold text-2xl pt-4 text-[#006f89]">〜届いた申請〜</p>
                <p v-if="props.recieveApplications.length==0" class="text-center font-bold text-1xl pt-4 text-[#e35748]">申請はありません。</p>
                <div v-else v-for="recieve in props.recieveApplications" :key="recieve.id">
                    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                        <div class="bg-white overflow-hidden shadow-md rounded-lg my-8">
                            <div class="flex">
                                <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                    <div class="grid justify-items-center">
                                        <div class="overflow-hidden rounded-full w-32 h-32">
                                            <img :src="recieve.add_info.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="w-full h-full object-cover bg-white" />
                                        </div>
                                        <div class="rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-24 mt-4">
                                            <form @submit.prevent="permission(recieve.sender_id)" >
                                                <input class='cursor-pointer' type="submit" value='承認'/>
                                            </form>
                                        </div>
                                        <div class="rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-24 mt-4">
                                            <form @submit.prevent="reject(recieve.sender_id)" >
                                                <input class='cursor-pointer' type="submit" value='却下'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex basis-2/3 px-10 py-6">
                                    <div class="text-[#004758] text-base/7 flex flex-col w-full">
                                        <div class="p-2 border-b border-[#006f89]">
                                            <span class="font-bold text-2xl">{{ recieve.add_info.name }}</span>
                                            <span class="text-lg ml-2">
                                                日本
                                                {{ recieve.add_info.age }}歳
                                                {{ recieve.add_info.gender_flag == 0 ? '男性' : '女性' }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-base mx-2 w-full">
                                                <div class="mt-4 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">居住地</p>
                                                    <p class="w-4/5 ml-2">{{ recieve.register_location ? recieve.register_location : '-' }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">よく行く</p>
                                                    <p class="w-4/5 ml-2">{{ recieve.often_go_location ? recieve.often_go_location : '-' }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">趣味</p>
                                                    <p class="w-4/5 ml-2">{{ recieve.hobby }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">ヒトコト</p>
                                                    <p class="w-4/5 ml-2">{{ recieve.add_info.comment ? recieve.add_info.comment : '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <p class="text-center font-bold text-2xl pt-4 text-[#006f89]">〜繋がった人〜</p>
                <p v-if="props.approvedApplications.length==0" class="text-center font-bold text-1xl pt-4 text-[#e35748]">繋がった人はいません。</p>
                <div v-else v-for="approved in props.approvedApplications" :key="approved.id">
                    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                        <div class="bg-white overflow-hidden shadow-md rounded-lg my-8">
                            <div class="flex">
                                <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                    <div class="grid justify-items-center">
                                        <div class="overflow-hidden rounded-full w-32 h-32">
                                            <img :src="approved.add_info.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex basis-2/3 px-10 py-6">
                                    <div class="text-[#004758] text-base/7 flex flex-col w-full">
                                        <div class="p-2 border-b border-[#006f89]">
                                            <span class="font-bold text-2xl">{{ approved.add_info.name }}</span>
                                            <span class="text-lg ml-2">
                                                日本 
                                                {{ approved.add_info.age }} 歳
                                                {{ approved.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-base mx-2 w-full">
                                                <div class="mt-4 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">居住地</p>
                                                    <p class="w-4/5 ml-2">{{ approved.register_location ? approved.register_location : '-' }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">よく行く</p>
                                                    <p class="w-4/5 ml-2">{{ approved.often_go_location ? approved.often_go_location : '-' }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">趣味</p>
                                                    <p class="w-4/5 ml-2">{{ approved.hobby }}</p>
                                                </div>
                                                
                                                <div class="mt-2 flex">
                                                    <p class="w-1/5 font-bold text-[#6c8489]">ヒトコト</p>
                                                    <p class="w-4/5 ml-2">{{ approved.add_info.comment ? approved.add_info.comment : '-' }}</p>
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
    </div>
</template>
