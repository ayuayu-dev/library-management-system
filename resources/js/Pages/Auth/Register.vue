<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="新規登録" />

        <form @submit.prevent="submit">

            <!-- 名前 -->
            <div>
                <InputLabel
                    for="name"
                    value="名前"
                    class="text-gray-700 text-sm"
                />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-md focus:border-[#8d6e63] focus:ring-[#8d6e63]"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- メールアドレス -->
            <div class="mt-4">
                <InputLabel
                    for="email"
                    value="メールアドレス"
                    class="text-gray-700 text-sm"
                />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-md focus:border-[#8d6e63] focus:ring-[#8d6e63]"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- パスワード -->
            <div class="mt-4">
                <InputLabel
                    for="password"
                    value="パスワード"
                    class="text-gray-700 text-sm"
                />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-md focus:border-[#8d6e63] focus:ring-[#8d6e63]"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- パスワード（確認用） -->
            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="パスワード（確認用）"
                    class="text-gray-700 text-sm"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-md focus:border-[#8d6e63] focus:ring-[#8d6e63]"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <!-- ボタン＋リンク -->
            <div class="mt-6 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-[#8d6e63] underline hover:text-[#795548]"
                >
                    すでに登録済みの方はこちら
                </Link>

                <PrimaryButton
                    class="ms-4 bg-[#8d6e63] hover:bg-[#795548] text-white rounded-xl"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    新規登録
                </PrimaryButton>
            </div>

        </form>
    </GuestLayout>
</template>
