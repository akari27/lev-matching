<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    users: Array,
    japanlocations: Array,
    hobbycategories: Array,
    applications: Array,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    selectedGender: null,
    selectedHobby: null,
    selectedRegisterLocation: null,
    selectedOftenGoLocation: null,
    selectedUser: null,
});

function isAllOptions() {
    return (
        form.selectedGender === null &&
        form.selectedHobby === null &&
        form.selectedRegisterLocation === null &&
        form.selectedOftenGoLocation === null
    );
}

function check() {
    if (isAllOptions()) {
        alert("最低1つ条件を選択してください。");
        event.preventDefault();
    } else {
        form.post(route('foreign.search.search'));
    }
}

// 下記UserListと全く同じ関数、全く同じコードこっちにかいてもいい？
function apply(id){
    form.selectedUser=id
    console.log(form.selectedUser)
    form.post(route('foreign.search.apply'))
}

function isApplicationSent(id) {
    return props.applications.some(app => app.reciever_id == id);
}

</script>

<template>
    <Head title="ForeignSearch" />
    
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pt-8 pb-8">
                    
                    <p class="text-center font-bold text-3xl pb-8">検索</p>

                    <form @submit.prevent="form.post(route('foreign.search.search'))" >
                        <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                            <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                                <div class="grid justify-items-center">
                                    <div class="m-5">
                                        <label for="selectedGender">性別:</label>
                                        <select v-model="form.selectedGender">
                                            <option value="null">全て</option>
                                            <option value=0>男性</option>
                                            <option value=1>女性</option>
                                        </select>
                                    </div>
                
                                    <div class="m-5">
                                        <label for="selectedHobbyr">趣味:</label>
                                        <select v-model="form.selectedHobby">
                                            <option :value="null">全て</option>
                                            <option v-for="hobby_category in props.hobbycategories" :value= "hobby_category.id">{{ hobby_category.name }}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="m-5">
                                        <label for="selectedRegisterLocation">住んでいる場所:</label>
                                        <select v-model="form.selectedRegisterLocation">
                                            <option :value="null">全て</option>
                                            <option v-for="japanlocation in props.japanlocations" :value= "japanlocation.id">{{ japanlocation.name }}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="m-5">
                                        <label for="selectedOftenGoLocation">よく行く場所:</label>
                                        <select v-model="form.selectedOftenGoLocation">
                                            <option :value="null">全て</option>
                                            <option v-for="japanlocation in props.japanlocations" :value= "japanlocation.id">{{ japanlocation.name }}</option>
                                        </select>
                                    </div>
                    
                                    <!-- submit -->
                                    <button
                                        class=""
                                        type="submit"
                                        :disabled="form.processing"
                                        @click="check">
                                        検索
                                    </button>
                                </div>
                            </div>
                        </div>
                                
                        <div v-for="user in props.users" :key="user.id">
                            <form @submit.prevent="apply(user.id)" >
                                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                                    <div class="bg-slate-300 overflow-hidden shadow-md sm:rounded-lg pt-4 pb-4 mt-8 mb-8">
                                        <div class="flex">
                                            <div class="flex-1">
                                                <div class="grid justify-items-center">
                                                    <div class="overflow-hidden rounded-full w-48 h-48">
                                                        <img :src="user.image_url" alt="画像が読み込めません。" class="w-full h-full object-cover" />
                                                    </div>
                                                    <p class="font-bold text-2xl">{{ user.name }}</p>
                                                    <p v-if="isApplicationSent(user.id)">申請済み</p>
                                                    <input v-else type="submit" value='申請'/>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="grid justify-items-center">
                                                    <div class="text-base/7">
                                                        <div class="text-xl">
                                                            <p>
                                                                日本
                                                                {{ user.age }} 歳
                                                                {{ user.gender_flag == 0 ? '男性' : '女性'}}
                                                            </p>
                                                            <p>居住地 : {{ user.register_location }}</p>
                                                            <p>よく行く : {{ user.often_go_location }}</p>
                                                            <p>趣味 : {{ user.hobby }}</p>
                                                            <p>ヒトコト : {{ user.comment }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>