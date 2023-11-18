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
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    gender_flag: user.gender_flag,
    age: user.age,
    is_japanese: user.is_japanese,
    comment: user.comment,
    hobby_category_id: user.hobby_category_id,
    register_location_id: user.japanese ? user.japanese.register_location_id : '未登録',
    often_go_location_id: user.japanese ? user.japanese.often_go_location_id : '未登録',
});

// const selectedRegion = ref('');

// // 都道府県のフィルタリング
// const filterPrefecturesByRegion = () => {
//     if (selectedRegion.value !== '') {
//         filteredPrefectures.value = props.japan_locations.filter(prefecture => prefecture.region_id === selectedRegion.value);
//     } else {
//         filteredPrefectures.value = [...props.japan_locations];
//     }
// };
// // selectedRegionが変更されたときにfilterPrefecturesByRegionメソッドを実行
// watch(selectedRegion, filterPrefecturesByRegion);

// // コンポーネントがマウントされたときに都道府県を初期化
// onMounted(() => {
//     filterPrefecturesByRegion();
// });

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">プロフィール情報</h2>

            <p class="mt-1 text-sm text-gray-600">
                アカウントのプロフィール情報とメールアドレスを更新します。
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

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
                <InputLabel for="email" value="Email" />

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
                <p>性別 ※変更不可</p>
                <p>{{ form.gender_flag == 0 ? '男性' : '女性' }}</p>
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
                <p>{{ form.is_japanese == 0 ? '日本人' : '外国人' }}</p>
            </div>
            
            <div>
                <InputLabel for="hobby_category_id" value="Hobby" />

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
            
            <!--<div>-->
            <!--    <InputLabel for="selectedRegion" value="Select Region" />-->
            <!--    <select-->
            <!--        id="selectedRegion"-->
            <!--        type="selectedRegion"-->
            <!--        class="mt-1 block w-full"-->
            <!--        v-model="selectedRegion"-->
            <!--        required-->
            <!--        autocomplete="username"-->
            <!--    >-->
            <!--        <option value="">-- 選択してください --</option>-->
            <!--        <option v-for="japan_region in props.japan_regions" :value="japan_region.id">{{ japan_region.name }}</option>-->
            <!--    </select>-->
            <!--</div>-->
            
            <!--<div>-->
            <!--    <InputLabel for="register_location_id" value="Register Location" />-->
            <!--    <select-->
            <!--        id="register_location_id"-->
            <!--        type="register_location_id"-->
            <!--        class="mt-1 block w-full"-->
            <!--        v-model="form.register_location_id"-->
            <!--        required-->
            <!--        autocomplete="username"-->
            <!--    >-->
            <!--        <option v-for="prefecture in filteredPrefectures" :value="prefecture.id">{{ prefecture.name }}</option>-->
            <!--    </select>-->
            <!--    <InputError class="mt-2" :message="form.errors.japanese_location_id" />-->
            <!--</div>-->

            <!--日本人に表示する項目-->
            <div>
                <InputLabel for="register_location_id" value="住んでいる都道府県" />

                <select
                    id="register_location_id"
                    type="register_location_id"
                    class="mt-1 block w-full"
                    v-model="form.register_location_id"
                    required
                    autocomplete="username"
                >
                    <option v-for="japan_location in props.japan_locations" :value="japan_location.id">{{ japan_location.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.japanese_location_id" />
            </div>
            
            <!--日本人に表示する項目-->
            <div>
                <InputLabel for="often_go_location_id" value="OftenGorLocation" />

                <select
                    id="often_go_location_id"
                    type="often_go_location_id"
                    class="mt-1 block w-full"
                    v-model="form.often_go_location_id"
                    required
                    autocomplete="username"
                >
                    <option v-for="japan_location in props.japan_locations" :value="japan_location.id">{{ japan_location.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.often_go_location_id" />
            </div>
            
            <!--日本人に表示する項目-->
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

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">保存</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>