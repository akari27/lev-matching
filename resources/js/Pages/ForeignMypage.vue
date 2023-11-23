<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    hobby_categories: Array,
    japan_regions: Array,
    japan_locations: Array,
    japanese: Object,
    countries: Array,
    foreign: Object,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    gender_flag: user.gender_flag,
    age: user.age,
    is_japanese: user.is_japanese,
    comment: user.comment,
    image_url: user.image_url,
    hobby_category_id: user.hobby_category_id,
    register_location_id: props.foreign.register_location_id!=null ? props.foreign.register_location_id : '未登録',
    stay_location_id: props.foreign.stay_location_id!=null ? props.foreign.stay_location_id : '未登録',
    start_of_stay: props.foreign.start_of_stay!=null ? props.foreign.start_of_stay : '未登録',
    end_of_stay: props.foreign.end_of_stay!=null ? props.foreign.end_of_stay : '未登録',
    reason: props.foreign.reason!=null ? props.foreign.reason : '',
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
                    <p>出身 : {{ form.register_location_id }}</p>
                    <p>滞在場所 : {{ form.stay_location_id }}</p>
                    <p>滞在期間 : {{ form.start_of_stay }} ~ {{ form.end_of_stay }}</p>
                    <p>訪日理由 : {{ form.reason }}</p>
                    <p>趣味 : {{ form.hobby_category_id }}</p>
                    <!--三項演算子 form.commentがnullなら未登録っていれる-->
                    <p>ヒトコト : {{ form.comment == null ? '未登録' : form.comment }}</p>
                    <a :href="route('foreignprofile.edit')"><button>プロフィール編集</button></a>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
