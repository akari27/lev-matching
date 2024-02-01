<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    hobbyCategories: Array,
    japanLocations: Array,
    japanese: Object,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    gender_flag: user.gender_flag,
    age: user.age,
    is_japanese: user.is_japanese,
    comment: user.comment,
    image_url: user.image_url,
    hobby_category_id: user.hobby_category_id,
    register_location_id: props.japanese.register_location_id!=null ? props.japanese.register_location_id : '未登録',
    often_go_location_id: props.japanese.often_go_location_id!=null ? props.japanese.often_go_location_id : '未登録',
});

function image_save($event){
    if ($event.target.files[0]==null) return
    form.image_url = $event.target.files[0]
    console.log(form.image_url)
}

// onMounted(()=>{
//     console.log(props.hobbyCategories);
// })

const updateProfile = () => {
    form.post(route('profile.update'), {
        preserveScroll: true,
    });
};

</script>

<template>
    <section>
        <!--<form @submit.prevent="form.post(route('profile.update'))" class="mt-6 space-y-6" enctype="multipart/form-data">-->
        <form @submit.prevent="updateProfile" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="名前 ※必須" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Eメール ※必須" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>
            
            <div>
                <InputLabel for="gender_flag" value="性別 ※必須" />
                <select
                    id="gender_flag"
                    type="gender_flag"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    v-model="form.gender_flag"
                    required
                    autocomplete="username"
                >
                    <option value="0">男性</option>
                    <option value="1">女性</option>
                </select>
                <InputError class="mt-2" :message="form.errors.gender_flag" />
            </div>
            
            <div>
                <InputLabel for="age" value="年齢 ※必須" />

                <TextInput
                    id="age"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.age"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.age" />
            </div>
            
            <div>
                <p class="text-sm text-gray-700">日本人か外国人か ※変更不可</p>
                <p class="mt-2 ml-2">{{ form.is_japanese == 1 ? '日本人' : '訪日外国人' }}</p>
            </div>
            
            <div>
                <InputLabel for="hobby_category_id" value="趣味 ※必須" />

                <select
                    id="hobby_category_id"
                    type="hobby_category_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    v-model="form.hobby_category_id"
                    required
                    autocomplete="username"
                >
                    <option v-for="hobbyCategory in props.hobbyCategories" :value="hobbyCategory.id">{{ hobbyCategory.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.hobby_category_id" />
            </div>
            
            <!--日本人に表示する項目-->
            <div>
                <InputLabel for="register_location_id" value="住んでいる場所" />

                <select
                    id="register_location_id"
                    type="register_location_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    v-model="form.register_location_id"
                    autocomplete="username"
                >
                    <option v-for="japanLocation in props.japanLocations" :value="japanLocation.id">{{ japanLocation.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.register_location_id" />
            </div>
            
            <!--日本人に表示する項目-->
            <div>
                <InputLabel for="often_go_location_id" value="よく行く場所" />

                <select
                    id="often_go_location_id"
                    type="often_go_location_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    v-model="form.often_go_location_id"
                    autocomplete="username"
                >
                    <option v-for="japanLocation in props.japanLocations" :value="japanLocation.id">{{ japanLocation.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.often_go_location_id" />
            </div>
            
            <div>
                <InputLabel for="comment" value="ヒトコト" />
                <TextInput
                    id="comment"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.comment"
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.comment" />
            </div>
            
            <div>
                <InputLabel for="image_url" value="image" />
                <input
                    id="image_url"
                    type="file"
                    class="mt-1 block w-full"
                    v-on:change="image_save($event)"
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.iamge_url" />
            </div>

            <div class="text-center">
                <PrimaryButton :disabled="form.processing">保存</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="pt-2 text-sm text-gray-600">プロフィールを更新しました。</p>
                </Transition>
            </div>
        </form>
    </section>
</template>