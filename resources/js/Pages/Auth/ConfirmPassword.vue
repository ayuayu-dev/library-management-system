<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="パスワード確認" />

        <!-- 説明文 -->
        <div class="mb-4 text-sm text-gray-600">
            ここはアプリのセキュアな領域です。先に進むにはパスワードを確認してください。
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="パスワード" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex justify-end">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    <!-- 処理中は「処理中…」に変更 -->
                    {{ form.processing ? '処理中…' : '確認する' }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
