<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted, onUpdated } from 'vue';

const chatArea = ref(null);

const user = usePage().props.auth.user;

const props = defineProps({
    user: Array,
    messages: Array,
});

const form = useForm({
    sendMessage: null,
    // このidってなに？→暗黙の了解でゲットしてきた選択したチャット相手のidっぽい
    receiver_id: props.user.id,
})

function send(){
    form.post(route('chat.send', {user: user, sendMessage: form.sendMessage}))
    form.reset('sendMessage')
}

onMounted(() => {
    scrollToBottom();
});

onUpdated(() => {
    scrollToBottom();
});

function scrollToBottom() {
    if (chatArea.value) {
        chatArea.value.scrollTop = chatArea.value.scrollHeight;
    }
}

</script>

<template>
    <Head title="チャット" />
    <div class="bg-[#fff7eeff] px-8 py-4">
        <AuthenticatedLayout>
            <div class="py-4">
                <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                    
                    <div class="bg-white overflow-hidden shadow-md rounded-lg pb-4 mt-2 mb-4">
                        <div class="bg-[#fdc562ff] overflow-hidden">
                            <p class="text-center font-bold text-2xl text-white mt-4 mb-4">{{ props.user.name }}</p>
                        </div>
                        <div ref="chatArea" class="h-96 overflow-y-auto my-2">
                            <div v-if="props.messages.length==0" class="flex items-center justify-center w-full h-full">
                                <div class="text-center text-xl text-[#e35748]">
                                    <p>メッセージはありません。</p>
                                    <p>{{ props.user.name }}さんと話しましょう！</p>
                                </div>
                            </div>
                            
                            <div v-else>
                                <div v-for="message in props.messages">
                                    <div class="w-full flex-col">
                                        <div v-if="message.sender_id==props.user.id" class="mt-4">
                                            <div class="flex justify-start">
                                                <div class="overflow-hidden rounded-full shadow-md ml-4 mt-2 w-10 h-10">
                                                    <img :src="props.user.image_url || 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701254979/kkrn_icon_user_3_wjwtry.png'" class="bg-white" />
                                                </div>
                                                <div class="ml-4 mr-12 py-3 px-4 bg-white shadow-md rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-[#004758ff]">
                                                    {{ message.message }}
                                                </div>
                                            </div>
                                            <div class="flex justify-start">
                                                <div class="ml-20 text-xs text-[#6c8489]">
                                                    {{ message.send_time }}
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="mt-4 mb-2">
                                            <div class="flex justify-end">
                                                <div class="ml-12 mr-4 text-[#004758ff] py-3 px-4 bg-[#ffe6b9ff] shadow-md rounded-bl-3xl rounded-tl-3xl rounded-tr-xl">
                                                    {{ message.message }}
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <div class="mr-6 text-xs text-[#6c8489]">
                                                    {{ message.send_time }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <form @submit.prevent="send" class="flex justify-center">
                            <div class="w-4/5 my-4 flex">
                                <div class="w-full">
                                    <input
                                        class="bg-[#ffe6b9ff] w-full border-none rounded-l-lg text-[#004758] focus:ring-[#006f89] placeholder:italic placeholder:text-[#897c67]"
                                        v-model="form.sendMessage"
                                        type="text"
                                        placeholder="メッセージを入力"
                                      />
                                </div>
                                <div class="bg-[#006f89] flex-shrink-0 px-4 py-2 rounded-r-lg">
                                    <button type="submit" class="font-bold text-white">送信</button>
                                </div>
                            </div>
                        </form>

                        <div>
                            <p v-if="form.errors.sendMessage" class="text-center text-red-500">{{ form.errors.sendMessage }}</p>
                        </div>
                        
                    </div>
                    
                    <a :href="route('chat.index')" class="text-[#006f89]">≪ ユーザ一覧に戻る</a>
                </div>
            </div> 
        </AuthenticatedLayout>
    </div>
</template>