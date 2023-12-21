<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const props = defineProps({
    user: Array,
    messages: Array,
});

const form = useForm({
    sendMessage: null,
    receiver_id: props.user.id,
})

function send(){
    form.post(route('chat.send', {user: user, sendMessage: form.sendMessage}))
}

</script>

<template>
    <Head title="Chat" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-8">
                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg pb-4 mt-8 mb-8">
                        <div class="bg-[#fdc562ff] overflow-hidden">
                            <p class="text-center font-bold text-2xl text-white mt-4 mb-4">{{ props.user.name }}</p>
                        </div>
                        
                        <div v-if="props.messages.length==0">
                            <p>
                                メッセージはありません。
                                {{ props.user.name }}さんと話しましょう！
                            </p>
                        </div>
                        
                        <div v-else>
                            <div v-for="message in props.messages">
                                <div v-if="message.sender_id==props.user.id" class="flex justify-items-start">
                                    <!--<div class="overflow-hidden rounded-full w-10 h-10">-->
                                    <!--    <img :src="props.user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />-->
                                    <!--</div>-->
                                    <div class="block w-3/4 ml-2 my-2 py-3 px-4 bg-white shadow-md rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-[#004758ff]">
                                        {{ message.message }} ({{ message.send_time }})
                                    </div>
                                </div>
                                <div v-else class="flex justify-items-end">
                                    <div class="block w-3/4 mr-2 my-2 py-3 px-4 bg-[#ffe6b9ff] shadow-md rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-[#004758ff]">
                                        {{ message.message }} ({{ message.send_time }})
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="grid justify-center">
                            <form @submit.prevent="send">
                                <div class="w-5/6 bg-[#ffe6b9ff] rounded-lg my-4 flex items-center">
                                    <div class="bg-[#ffe6b9ff]">
                                        <input
                                            class="w-full sm:w-2/3 bg-[#ffe6b9ff] text-[#006f89] border border-gray-200 overflow-hidden"
                                            v-model="form.sendMessage"
                                            type="text"
                                            placeholder="メッセージを入力"
                                          />
                                    </div>
                                    <div class="bg-[#006f89] w-1/6 flex-shrink-0">
                                        <button type="submit" class="font-bold text-white px-4 py-2">送信</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        
                    </div>
                    
                    <a :href="route('chat.index')">≪ ユーザ一覧に戻る</a>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>