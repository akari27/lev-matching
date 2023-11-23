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
    // 入れ子構造なので注意　edit.vue
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
    email: user.email,
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
});

function image_save($event){
    if ($event.target.files[0]==null) return
    form.image_url = $event.target.files[0]
    console.log(form.image_url)
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">プロフィール情報</h2>

            <p class="mt-1 text-sm text-gray-600">
                アカウントのプロフィール情報とメールアドレスを更新します。
            </p>
        </header>

        <form @submit.prevent="form.post(route('foreignprofile.update'))" class="mt-6 space-y-6" enctype="multipart/form-data">
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
                <InputLabel for="email" value="Email ※必須" />

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
                    class="mt-1 block w-full"
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
                <InputLabel for="age" value="Age" />

                <TextInput
                    id="age"
                    type="age"
                    class="mt-1 block w-full"
                    v-model="form.age"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.age" />
            </div>
            
            <div>
                <p>日本人か外国人か ※変更不可</p>
                <p>{{ form.is_japanese == 1 ? '日本人' : '外国人' }}</p>
            </div>
            
            <div>
                <InputLabel for="hobby_category_id" value="Hobby ※必須" />

                <select
                    id="hobby_category_id"
                    type="hobby_category_id"
                    class="mt-1 block w-full"
                    v-model="form.hobby_category_id"
                    required
                    autocomplete="username"
                >
                    <option v-for="hobby_category in props.hobby_categories" :value="hobby_category.id">{{ hobby_category.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.hobby_category_id" />
            </div>
            
            <!--外国人に表示する項目-->
            <div>
                <InputLabel for="register_location_id" value="RegisterLocation" />

                <select
                    id="register_location_id"
                    type="register_location_id"
                    class="mt-1 block w-full"
                    v-model="form.register_location_id"
                    required
                    autocomplete="username"
                >
                    <option v-for="country in props.countries" :value="country.id">{{ country.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.often_go_location_id" />
            </div>

        <!--外国人に表示する項目-->
            <div>
                <InputLabel for="stay_location_id" value="StayLocation" />

                <select
                    id="stay_location_id"
                    type="stay_location_id"
                    class="mt-1 block w-full"
                    v-model="form.stay_location_id"
                    required
                    autocomplete="username"
                >
                    <option v-for="japan_location in props.japan_locations" :value="japan_location.id">{{ japan_location.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.stay_location_id" />
            </div>

        <!--外国人に表示する項目-->
            <div>
                <InputLabel for="start_of_stay" value="StartOfStay" />

                <input
                    id="start_of_stay"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.start_of_stay"
                    required
                    autocomplete="username"
                >
                <InputError class="mt-2" :message="form.errors.start_of_stay" />
            </div>

        <!--外国人に表示する項目-->
            <div>
                <InputLabel for="end_of_stay" value="EndOfStay" />

                <input
                    id="end_of_stay"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.end_of_stay"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.end_of_stay" />
            </div>
            
            <!--外国人に表示する項目-->
            <div>
                <InputLabel for="reason" value="Reason" />
                <TextInput
                    id="reason"
                    type="reason"
                    class="mt-1 block w-full"
                    v-model="form.reason"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.reason" />
            </div>
            
            <div>
                <InputLabel for="comment" value="Comment" />
                <TextInput
                    id="comment"
                    type="comment"
                    class="mt-1 block w-full"
                    v-model="form.comment"
                    required
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
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.iamge_url" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">保存</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>