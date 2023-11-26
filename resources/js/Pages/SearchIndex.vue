<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';

const props = defineProps({
    users: Array,
    japanlocations: Array,
    countries: Array,
    hobbycategories: Array,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    selectedGender: null,
    selectedHobby: null,
    selectedRegisterLocation: null,
    selectedStayLocation: null,
});

onMounted(() => {
    console.log(props.users);
})

</script>

<template>
    <Head title="Dashboard" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">検索</h2>
        </template>

        <div class="mt-12 mx-auto w-1/4 p-6 bg-cyan-100 border-2 border-gray-200 flex-col rounded">
            <form @submit.prevent="form.post(route('search.search'))" >
              
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
                    <label for="selectedRegisterLocation">出身国:</label>
                    <select v-model="form.selectedRegisterLocation">
                        <option :value="null">全て</option>
                        <option v-for="country in props.countries" :value= "country.id">{{ country.name }}</option>
                    </select>
                </div>
                
                <div class="m-5">
                    <label for="selectedStayLocation">訪問場所:</label>
                    <select v-model="form.selectedStayLocation">
                        <option :value="null">全て</option>
                        <option v-for="japanlocation in props.japanlocations" :value= "japanlocation.id">{{ japanlocation.name }}</option>
                    </select>
                </div>

              <!-- submit -->
                <button
                    class="ml-auto border-2 border-gray-200 bg-cyan-100 px-2 flex"
                    type="submit"
                    :disabled="form.processing">
                    検索
                </button>
                <li v-for="user in props.users" :key="user.id">
                    {{ user.name }}
                    {{ user.gender_flag == 0 ? '男性' : '女性'}}
                    {{ user.age }} 歳
                    {{ user.comment }}
                    {{ user.image_url }}
                    {{ user.register_location_id }}
                    {{ user.stay_location_id }}
                    {{ user.start_of_stay }} ~ {{ user.end_of_stay }}
                    {{ user.reason }}
                </li>
          </form>
        </div>
    </AuthenticatedLayout>
</template>