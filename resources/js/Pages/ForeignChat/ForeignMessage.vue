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
                <p class="text-center font-bold text-3xl text-[#006f89]">チャット</p>
                
                チャット相手 : {{ props.user }}
                
                {{ props.messages }}
                
                <div v-if="props.messages.length==0">
                    <p>
                        メッセージはありません。
                        {{ props.user.name }}さんと話しましょう！
                    </p>
                </div>
                <div v-else>
                    <div v-for="message in props.messages">
                        {{ message.sender_id }} {{ message.message }}
                    </div>
                </div>
                
                <form @submit.prevent="send">
                    <input type="text" v-model="form.sendMessage" />
                    <button type="submit">送信</button>
                </form>
                
            </div>
        </AuthenticatedLayout>
    </div>
</template>
