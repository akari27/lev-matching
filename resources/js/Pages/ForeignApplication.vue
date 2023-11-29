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
    <Head title="ForeignApplication" />
    
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pt-8 pb-8">
                    
                    <p class="text-center font-bold text-3xl pb-8">申請リスト</p>
                    
                    <p class="text-center font-bold text-2xl">〜申請済み〜</p>
                    <p v-if="props.sendApplications.length==0">承認待ちの申請はありません。</p>
                    <div v-else v-for="send in props.sendApplications" :key="send.id">
                        <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                            <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                                <div class="flex">
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <img :src="send.add_info.image_url" alt="https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png" width="100" height="100"/>
                                            <p class="font-bold text-2xl">{{ send.add_info.name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <div class="text-base/7">
                                                <div class="text-xl">
                                                    <p>
                                                        日本
                                                        {{ send.add_info.age }} 歳
                                                        {{ send.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                                    </p>
                                                    <p>居住地 : {{ send.register_location }}</p>
                                                    <p>よく行く : {{ send.often_go_location }}</p>
                                                    <p>趣味 : {{ send.hobby }}</p>
                                                    <p>ヒトコト : {{ send.add_info.comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-center font-bold text-2xl">〜届いた申請〜</p>
                    <p v-if="props.recieveApplications.length==0" class="text-center text-1xl">申請はありません。</p>
                    <div v-else v-for="recieve in props.recieveApplications" :key="recieve.id">
                        <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                            <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                                <div class="flex">
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <img :src="recieve.add_info.image_url" alt="https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png" width="100" height="100"/>
                                            <p class="font-bold text-2xl">{{ recieve.add_info.name }}</p>
                                            <form @submit.prevent="permission(recieve.sender_id)" >
                                                <input type="submit" value='承認'/>
                                            </form>
                                            <form @submit.prevent="reject(recieve.sender_id)" >
                                                <input type="submit" value='却下'/>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <div class="text-base/7">
                                                <div class="text-xl">
                                                    <p>
                                                        日本
                                                        {{ recieve.add_info.age }}歳
                                                        {{ recieve.add_info.gender_flag == 0 ? '男性' : '女性' }}
                                                    </p>
                                                    <p>居住地 : {{ recieve.register_location }}</p>
                                                    <p>よく行く : {{ recieve.often_go_location }}</p>
                                                    <p>趣味 : {{ recieve.hobby }}</p>
                                                    <p>ヒトコト : {{ recieve.add_info.comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-center font-bold text-2xl">〜繋がった人〜</p>
                    <p v-if="props.approvedApplications.length==0">繋がった人はいません。</p>
                    <div v-else v-for="approved in props.approvedApplications" :key="approved.id">
                        <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                            <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                                <div class="flex">
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <img :src="approved.add_info.image_url" alt="https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png" width="100" height="100"/>
                                            <p class="font-bold text-2xl">{{ approved.add_info.name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <div class="text-base/7">
                                                <div class="text-xl">
                                                    <p>
                                                        日本
                                                        {{ approved.add_info.age }}歳
                                                        {{ approved.add_info.gender_flag == 0 ? '男性' : '女性' }}
                                                    </p>
                                                    <p>居住地 : {{ approved.register_location }}</p>
                                                    <p>よく行く : {{ approved.often_go_location }}</p>
                                                    <p>趣味 : {{ approved.hobby }}</p>
                                                    <p>ヒトコト : {{ approved.add_info.comment }}</p>
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
        </div>
    </AuthenticatedLayout> 
</template>