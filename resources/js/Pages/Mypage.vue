<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';


const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    gender_flag: user.gender_flag,
    age: user.age,
    is_japanese: user.is_japanese,
    hobby_category_id : user.hobby_category_id,
    comment: user.comment,
    register_location_id: user.japanese ? user.japanese.register_location_id: '未登録',
    often_go_location_id: user.japanese ? user.japanese.often_go_location_id: '未登録',
})

onMounted(() => {
    console.log(user.japanese);
    console.log(user.japanese ? user.japanese.register_location_id: '未登録')
})



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mypage</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <p>{{ form.name }}{{ form.is_japanese }}{{ form.age }}{{ form.gender_flag }}</p>
                    <p>場所 : {{ form.register_location_id }}</p>
                    <p>よく行く : {{ form.often_go_location_id }}</p>
                    <p>趣味 : {{ form.hobby_category_id }}</p>
                    <!--三項演算子 form.commentがnullなら未登録っていれる-->
                    <p>ヒトコト : {{ form.comment == null ? '未登録' : form.comment }}</p>
                    <a :href="route('profile.edit')"><button>プロフィール編集</button></a>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
