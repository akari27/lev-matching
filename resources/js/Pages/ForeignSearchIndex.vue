<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import { onUpdated, ref, computed } from 'vue';

const props = defineProps({
    users: Array,
    japanlocations: Array,
    hobbycategories: Array,
    applications: Array,
});

const user = usePage().props.auth.user;

onUpdated(()=>{
    console.log(form.allUsers)
})

const form = useForm({
    name: user.name,
    selectedGender: null,
    selectedHobby: null,
    selectedRegisterLocation: null,
    selectedOftenGoLocation: null,
    selectedUser: null,
    allUsers: null,
});

form.allUsers = computed(()=>props.users)

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

function apply(id){
    form.selectedUser=id
    console.log(form.selectedUser)
    form.post(route('foreign.search.apply'),{
        preserveScroll: true,
    })
}

function isApplicationSent(id) {
    return props.applications.some(app => app.receiver_id == id);
}

</script>

<template>
    <Head title="Search" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-8">
                <p class="text-center font-bold text-3xl text-[#006f89]">検索</p>
                <form @submit.prevent="form.post(route('foreign.search.search'))" >
                    <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                        <div class="bg-white overflow-hidden shadow-md rounded-lg pb-4 mt-8 mb-8">
                            
                            <div class="bg-[#006f89] overflow-hidden">
                                <p class="text-center font-bold text-2xl text-white mt-4 mb-4">条件を選んでください</p>
                            </div>
                            
                            <div class="grid justify-center">
                                <div class="mt-4">
                                    <label for="selectedGender" class="block text-[#00323e]">性別</label>
                                    <select v-model="form.selectedGender" class="block bg-[#006f8920] text-[#00323e] rounded-lg focus:ring-[#006f89] outline-none w-48">
                                        <option :value="null">全て</option>
                                        <option :value=0>男性</option>
                                        <option :value=1>女性</option>
                                    </select>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="selectedHobbyr" class="block text-[#00323e]">趣味</label>
                                    <select v-model="form.selectedHobby" class="block bg-[#006f8920] text-[#00323e] rounded-lg focus:ring-[#006f89] focus:outline-none w-48">
                                        <option :value="null">全て</option>
                                        <option v-for="hobby_category in props.hobbycategories" :value= "hobby_category.id">{{ hobby_category.name }}</option>
                                    </select>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="selectedRegisterLocation" class="block text-[#00323e]">住んでいる場所</label>
                                    <select v-model="form.selectedRegisterLocation" class="block bg-[#006f8920] text-[#00323e] rounded-lg focus:ring-[#006f89] w-48">
                                        <option :value="null">全て</option>
                                        <option v-for="japanlocation in props.japanlocations" :value= "japanlocation.id">{{ japanlocation.name }}</option>
                                    </select>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="selectedOftenGoLocation" class="block -[#00323e]">よくいく場所</label>
                                    <select v-model="form.selectedOftenGoLocation" class="block bg-[#006f8920] text-[#00323e] rounded-lg focus:ring-[#006f89] w-48">
                                        <option :value="null">全て</option>
                                        <option v-for="japanlocation in props.japanlocations" :value= "japanlocation.id">{{ japanlocation.name }}</option>
                                    </select>
                                </div>
                                
                                <!-- submit -->
                                <div class="mt-4 text-center">
                                    <button
                                        class="bg-[#006f89] text-white rounded-lg w-20"
                                        type="submit"
                                        :disabled="form.processing"
                                        @click="check">
                                        検索
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div v-if="props.users!=null">
                        <div class="text-center text-lg font-bold text-[#e35748]">
                            <p v-if="props.users.length==0">ユーザが見つかりませんでした。</p>
                            <p v-else>{{ props.users.length }}人見つかりました。</p>
                        </div>
                    </div>
                    
                    
                    
                    <!--検索結果の表示-->
                    <div v-for="user in props.users" :key="user.id">
                        <form @submit.prevent="apply(user.id)">
                            <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                                <div class="bg-white overflow-hidden shadow-md rounded-lg my-8">
                                    <div class="flex">
                                        <div class="flex items-center justify-center basis-1/3 bg-[#fdc562ff]">
                                            <div class="grid justify-items-center">
                                                <div class="overflow-hidden rounded-full w-32 h-32">
                                                    <img :src="user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="w-full h-full object-cover bg-white" />
                                                </div>
                                                <div class="rounded-lg bg-[#ffe6b9ff] text-center text-xl text-[#004758] w-24 mt-4">
                                                    <p v-if="isApplicationSent(user.id)">申請済み</p>
                                                    <input v-else type="submit" class="font-bold cursor-pointer" value='申請'/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex basis-2/3 px-10 py-6">
                                            <div class="text-[#004758] text-base/7 flex flex-col w-full">
                                                <div class="p-2 border-b border-[#006f89]">
                                                    <span class="font-bold text-2xl">{{ user.name }}</span>
                                                    <span class="text-lg ml-2">
                                                        日本
                                                        {{ user.age }} 歳
                                                        {{ user.gender_flag == 0 ? '男性' : '女性'}}
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="text-base mx-2 w-full">
                                                        <div class="mt-4 flex">
                                                            <p class="w-1/5 font-bold text-[#6c8489]">居住地</p>
                                                            <p class="w-4/5 ml-2">{{ user.register_location ? user.register_location : '-' }}</p>
                                                        </div>
                                                        
                                                        <div class="mt-2 flex">
                                                            <p class="w-1/5 font-bold text-[#6c8489]">よく行く</p>
                                                            <p class="w-4/5 ml-2">{{ user.often_go_location ? user.often_go_location : '-'}}</p>
                                                        </div>
                                                        
                                                        <div class="mt-2 flex">
                                                            <p class="w-1/5 font-bold text-[#6c8489]">趣味</p>
                                                            <p class="w-4/5 ml-2">{{ user.hobby }}</p>
                                                        </div>
                                                        
                                                        <div class="mt-2 flex">
                                                            <p class="w-1/5 font-bold text-[#6c8489]">ヒトコト</p>
                                                            <p class="w-4/5 ml-2">{{ user.comment ? user.comment : '-'}}</p>
                                                        </div>
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
        </AuthenticatedLayout>
    </div>
</template>