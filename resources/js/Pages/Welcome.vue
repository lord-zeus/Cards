<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import axios from "axios";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
const form = useForm({
    number_people: '',
    user_values: []
});


const submit = () => {
    form.errors.number_people = ''
    axios.post(route('generate'), {
        number_people: form.number_people
    }).then((resp) => {
        form.user_values = resp.data
    })
        .catch((error) => {
        form.errors.number_people = error.response.data.message['number_people'][0]
    });
};
</script>

<template>
    <Head title="Welcome" />

    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="number_people" value="Number People" />

                <TextInput
                    id="number_people"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.number_people"
                    required
                />

                <InputError class="mt-2" :message="form.errors.number_people" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Play
                </PrimaryButton>
            </div>
        </form>
        <div v-if="form.user_values.length > 0" class="mt-8">

            <h1> Results </h1>

            <ul class="">
                <li v-for="user in form.user_values">{{ user['cards'].toString()}}</li>
                <!-- ... -->
            </ul>
        </div>
    </GuestLayout>
</template>
