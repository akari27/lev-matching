<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

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
    email: user.email,
    gender_flag: user.gender_flag,
    age: user.age,
    is_japanese: user.is_japanese,
    comment: user.comment,
    image_url: user.image_url,
    hobby_category_id: user.hobby_category_id,
    register_location_id: props.foreign.register_location_id!=null ? props.foreign.register_location_id : null,
    stay_location_id: props.foreign.stay_location_id!=null ? props.foreign.stay_location_id : null,
    start_of_stay: props.foreign.start_of_stay!=null ? props.foreign.start_of_stay : null,
    end_of_stay: props.foreign.end_of_stay!=null ? props.foreign.end_of_stay : null,
    reason: props.foreign.reason!=null ? props.foreign.reason : null,
});

function image_save($event){
    if ($event.target.files[0]==null) return
    form.image_url = $event.target.files[0]
    console.log(form.image_url)
}

const updateProfile = () => {
    form.post(route('foreign.profile.update'), {
        preserveScroll: true,
    });
};

</script>

<template>
    <section>
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
                    class="mt-1 block w-full border-gray-300 text-[#004758] focus:border-[#006f89] focus:ring-[#006f89] rounded-md shadow-sm"
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
                <InputLabel for="age" value="年齢" />

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
                <p class="text-sm text-gray-700">Japanese or Foreigners Visiting Japan  *Unchangeable</p>
                <p class="mt-2 ml-2">{{ form.is_japanese == 1 ? 'Japanese' : 'Foreigners Visiting Japan' }}</p>
            </div>
            
            <div>
                <InputLabel for="hobby_category_id" value="趣味 ※必須" />

                <select
                    id="hobby_category_id"
                    type="hobby_category_id"
                    class="mt-1 block w-full border-gray-300 text-[#004758] focus:border-[#006f89] focus:ring-[#006f89] rounded-md shadow-sm"
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
                <InputLabel for="register_location_id" value="居住地" />

                <select
                    id="register_location_id"
                    type="register_location_id"
                    class="mt-1 block w-full border-gray-300 text-[#004758] focus:border-[#006f89] focus:ring-[#006f89] rounded-md shadow-sm"
                    v-model="form.register_location_id"
                    autocomplete="username"
                >
                    <option v-for="country in props.countries" :value="country.id">{{ country.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.often_go_location_id" />
            </div>

        <!--外国人に表示する項目-->
            <div>
                <InputLabel for="stay_location_id" value="訪問場所" />

                <select
                    id="stay_location_id"
                    type="stay_location_id"
                    class="mt-1 block w-full border-gray-300 text-[#004758] focus:border-[#006f89] focus:ring-[#006f89] rounded-md shadow-sm"
                    v-model="form.stay_location_id"
                    autocomplete="username"
                >
                    <option v-for="japan_location in props.japan_locations" :value="japan_location.id">{{ japan_location.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.stay_location_id" />
            </div>

        <!--外国人に表示する項目-->
            <div>
                <InputLabel for="start_of_stay" value="訪問日" />

                <input
                    id="start_of_stay"
                    type="date"
                    class="mt-1 block w-full border-gray-300 text-[#004758] focus:border-[#006f89] focus:ring-[#006f89] rounded-md shadow-sm"
                    v-model="form.start_of_stay"
                    autocomplete="username"
                >
                <InputError class="mt-2" :message="form.errors.start_of_stay" />
            </div>

        <!--外国人に表示する項目-->
            <div>
                <InputLabel for="end_of_stay" value="帰国日" />

                <input
                    id="end_of_stay"
                    type="date"
                    class="mt-1 block w-full border-gray-300 text-[#004758] focus:border-[#006f89] focus:ring-[#006f89] rounded-md shadow-sm"
                    v-model="form.end_of_stay"
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.end_of_stay" />
            </div>
            
            <!--外国人に表示する項目-->
            <div>
                <InputLabel for="reason" value="訪日理由" />
                <TextInput
                    id="reason"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.reason"
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.reason" />
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
                <InputLabel for="image_url" value="プロフィール画像" />
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
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Profile has been updated.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>