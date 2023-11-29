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
    
    <AuthenticatedLayout>
        <!--<template #header>-->
        <!--    <h2 class="font-semibold text-xl text-gray-800 leading-tight">一覧</h2>-->
        <!--</template>-->
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
                                            <img :src="send.add_info.image_url" alt="画像が読み込めません。" width="100" height="100"/>
                                            <p class="font-bold text-2xl">{{ send.add_info.name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <div class="text-base/7">
                                                <div class="text-xl">
                                                    <p>
                                                        {{ send.register_location }} 
                                                        {{ send.add_info.age }} 歳
                                                        {{ send.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                                    </p>
                                                    <p>滞在期間: {{ send.add_info.foreign_visitor.start_of_stay }} ~ {{ send.add_info.foreign_visitor.end_of_stay }}</p>
                                                    <p>訪問場所:  {{ send.stay_location }}</p>
                                                    <p>趣味: {{ send.hobby }}</p>
                                                    <p>訪日理由: {{ send.add_info.foreign_visitor.reason }}</p>
                                                    <p>ヒトコト: {{ send.add_info.comment }}</p>
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
                                            <img :src="recieve.add_info.image_url" alt="画像が読み込めません。" width="100" height="100"/>
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
                                                        {{ recieve.register_location }} 
                                                        {{ recieve.add_info.age }} 歳
                                                        {{ recieve.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                                    </p>
                                                    <p>滞在期間: {{ recieve.add_info.foreign_visitor.start_of_stay }} ~ {{ recieve.add_info.foreign_visitor.end_of_stay }}</p>
                                                    <p>訪問場所:  {{ recieve.stay_location }}</p>
                                                    <p>趣味: {{ recieve.hobby }}</p>
                                                    <p>訪日理由: {{ recieve.add_info.foreign_visitor.reason }}</p>
                                                    <p>ヒトコト: {{ recieve.add_info.comment }}</p>
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
                                            <img :src="approved.add_info.image_url" alt="画像が読み込めません。" width="100" height="100"/>
                                            <p class="font-bold text-2xl">{{ approved.add_info.name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <div class="text-base/7">
                                                <div class="text-xl">
                                                    <p>
                                                        {{ approved.register_location }} 
                                                        {{ approved.add_info.age }} 歳
                                                        {{ approved.add_info.gender_flag == 0 ? '男性' : '女性'}}
                                                    </p>
                                                    <p>滞在期間: {{ approved.add_info.foreign_visitor.start_of_stay }} ~ {{ approved.add_info.foreign_visitor.end_of_stay }}</p>
                                                    <p>訪問場所:  {{ approved.stay_location }}</p>
                                                    <p>趣味: {{ approved.hobby }}</p>
                                                    <p>訪日理由: {{ approved.add_info.foreign_visitor.reason }}</p>
                                                    <p>ヒトコト: {{ approved.add_info.comment }}</p>
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