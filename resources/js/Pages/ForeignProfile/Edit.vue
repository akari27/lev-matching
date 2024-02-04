<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInfomationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    hobby_categories: Array,
    japan_regions: Array,
    japan_locations: Array,
    countries: Array,
    foreign: Object,
});
</script>



<template>
    <Head title="Profile" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-12">
                <p class="text-center font-bold text-3xl pb-4 text-[#006f89]">プロフィール編集</p>
                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                    
                    <a :href="route('foreign.mypage')" class="mt-6 text-[#006f89]">≪ マイページへ戻る</a>
                    
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pb-6 mt-2 my-8">
                        <div class="bg-[#006f89] overflow-hidden">
                            <p class="text-center font-bold text-2xl text-white mt-4 mb-4">基本情報</p>
                        </div>
                        
                        <div class="flex justify-center">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                :hobby_categories="hobby_categories"
                                :japan_locations="japan_locations"
                                :countries="countries"
                                :foreign="foreign"
                                class="max-w-xl"
                            />
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pb-6 my-8">
                        <div class="bg-[#006f89] overflow-hidden">
                            <p class="text-center font-bold text-2xl text-white mt-4 mb-4">パスワード更新</p>
                        </div>
                        <div class="flex justify-center">
                            <UpdatePasswordForm class="max-w-xl flex justify-center" />
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg pb-6 my-8">
                        <div class="bg-[#006f89] overflow-hidden">
                            <p class="text-center font-bold text-2xl text-white mt-4 mb-4">退会</p>
                        </div>
                        <div class="flex justify-center">
                            <DeleteUserForm class="max-w-xl" />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
