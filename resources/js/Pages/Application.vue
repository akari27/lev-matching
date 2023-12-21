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
    form.post(route('application.permission'))
}
function reject(id){
    form.senderId = id
    form.post(route('application.reject'))
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
                                            <img :src="send.add_info.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex basis-2/3 p-8">
                                    <div class="grid justify-items-center">
                                        <div class="text-base/7 text-[#004758]">
                                            <span class="font-bold text-2xl">{{ send.add_info.name }}</span>
                                            <span class="text-lg ml-2">
                                                {{ send.register_location }} 
                                                {{ send.add_info.age }} 歳
                                                {{ send.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                            </span>
                                            <div class="text-lg">
                                                <div class="mt-4">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">滞在期間</span>
                                                    <span class="font-bold text-xl pl-4">{{ send.add_info.foreign_visitor.start_of_stay }} ~ {{ send.add_info.foreign_visitor.end_of_stay }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪問場所</span>
                                                    <span class="font-bold text-xl pl-4">{{ send.stay_location }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">趣味</span>
                                                    <span class="font-bold text-xl pl-4">{{ send.hobby }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪日理由</p>
                                                    <p class="font-bold text-xl pl-4">{{ send.add_info.foreign_visitor.reason }}</p>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">ヒトコト</p>
                                                    <p class="font-bold text-xl pl-4">{{ send.add_info.comment }}</p>
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
                                            <img :src="recieve.add_info.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />
                                        </div>
                                        <div class="rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-24 mt-4">
                                            <form @submit.prevent="permission(recieve.sender_id)" >
                                                <input type="submit" value='承認'/>
                                            </form>
                                        </div>
                                        <div class="rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-24 mt-4">
                                            <form @submit.prevent="reject(recieve.sender_id)" >
                                                <input type="submit" value='却下'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex basis-2/3 p-8">
                                    <div class="grid justify-items-center">
                                        <div class="text-base/7 text-[#004758]">
                                            <span class="font-bold text-2xl">{{ recieve.add_info.name }}</span>
                                            <span class="text-lg ml-2">
                                                {{ recieve.register_location }} 
                                                {{ recieve.add_info.age }} 歳
                                                {{ recieve.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                            </span>
                                            <div class="text-lg">
                                                <div class="mt-4">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">滞在期間</span>
                                                    <span class="font-bold text-xl pl-4">{{ recieve.add_info.foreign_visitor.start_of_stay }} ~ {{ recieve.add_info.foreign_visitor.end_of_stay }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪問場所</span>
                                                    <span class="font-bold text-xl pl-4">{{ recieve.stay_location }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">趣味</span>
                                                    <span class="font-bold text-xl pl-4">{{ recieve.hobby }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪日理由</p>
                                                    <p class="font-bold text-xl pl-4">{{ recieve.add_info.foreign_visitor.reason }}</p>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">ヒトコト</p>
                                                    <p class="font-bold text-xl pl-4">{{ recieve.add_info.comment }}</p>
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
                                <div class="flex basis-2/3 p-8">
                                    <div class="grid justify-items-center">
                                        <div class="text-base/7 text-[#004758]">
                                            <span class="font-bold text-2xl">{{ approved.add_info.name }}</span>
                                            <span class="text-lg ml-2">
                                                {{ approved.register_location }} 
                                                {{ approved.add_info.age }} 歳
                                                {{ approved.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                            </span>
                                            <div class="text-lg">
                                                <div class="mt-4">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">滞在期間</span>
                                                    <span class="font-bold text-xl pl-4">{{ approved.add_info.foreign_visitor.start_of_stay }} ~ {{ approved.add_info.foreign_visitor.end_of_stay }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪問場所</span>
                                                    <span class="font-bold text-xl pl-4">{{ approved.stay_location }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <span class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">趣味</span>
                                                    <span class="font-bold text-xl pl-4">{{ approved.hobby }}</span>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">訪日理由</p>
                                                    <p class="font-bold text-xl pl-4">{{ approved.add_info.foreign_visitor.reason }}</p>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <p class="text-center rounded-lg bg-[#ede4dfff] inline-block w-18">ヒトコト</p>
                                                    <p class="font-bold text-xl pl-4">{{ approved.add_info.comment }}</p>
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