<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const props = defineProps({
    users: Array,
    application: Array,
});

const form = useForm({
    selectedUser: null,
});

function apply(id){
    form.selectedUser=id
    console.log(form.selectedUser)
    form.post(route('list.apply'))
}

function isApplicationSent(id) {
    // props.applicationの配列の中にreceiver_idが同一idのものがあるか？(=申請済みかどうか？)
    // someメソッドは配列内の各要素(app)に対し、receiver_idとid(引数)と等しいものがあるかチェックするメソッド。等しいものがあったらTrueを返す。
    return props.application.some(app => app.receiver_id == id);
}
</script>

<template>
    <Head title="UserList" />
    
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pt-8 pb-8">
                    
                    <p class="text-center font-bold text-3xl pb-8">一覧</p>
                    
                    <div v-for="user in props.users" :key="user.id">
                        
                        
                        <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                            <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                                <div class="flex">
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <img :src="user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'"  width="100" height="100"/>
                                            <p class="font-bold text-2xl">{{ user.name }}</p>
                                            <form @submit.prevent="apply(user.id)" >
                                                <p v-if="isApplicationSent(user.id)">申請済み</p>
                                                <input v-else type="submit" value='申請'/>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="grid justify-items-center">
                                            <div class="text-base/7">
                                                <div class="text-xl">
                                                    <p>
                                                        {{ user.register_location }} 
                                                        {{ user.age }} 歳
                                                        {{ user.gender_flag == 0 ? '男性' : '女性'}}
                                                    </p>
                                                    <p>滞在期間: {{ user.foreign_visitor.start_of_stay }} ~ {{ user.foreign_visitor.end_of_stay }}</p>
                                                    <p>訪問場所:  {{ user.stay_location }}</p>
                                                    <p>趣味: {{ user.hobby }}</p>
                                                    <p>訪日理由: {{ user.foreign_visitor.reason }}</p>
                                                    <p>ヒトコト: {{ user.comment }}</p>
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