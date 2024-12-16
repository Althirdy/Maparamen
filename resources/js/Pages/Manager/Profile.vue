<script setup>
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ArrowLeft } from 'lucide-vue-next'
import BranchManager from '../../Layouts/BranchManager.vue';


const form = useForm({
  crew_id: 'CREW001',
  first_name: 'Jin',
  last_name: 'Dela Cruz',
  mobile_no: '+63 9271866280',
})

const emailForm = useForm({
  email: 'jindelacruz@example.com'
})

const passwordForm = useForm({
  current_password: '',
  new_password: '',
  new_password_confirmation: ''
})

const updateProfile = () => {
  form.patch(route('profile.update'))
}

const updateEmail = () => {
  emailForm.patch(route('profile.email'))
}

const updatePassword = () => {
  passwordForm.patch(route('profile.password'))
}
</script>

<template>
    <Head title="My Profile" />
    <BranchManager>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
                <!-- Profile Information -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                My Profile
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                Update your account's profile information.
                            </p>
                        </header>

                        <form
                            @submit.prevent="updateProfile"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >Crew ID</label
                                >
                                <input
                                    type="text"
                                    v-model="form.crew_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    readonly
                                />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block font-medium text-sm text-gray-700"
                                        >First name</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.first_name"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="block font-medium text-sm text-gray-700"
                                        >Last name</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.last_name"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >Mobile no.</label
                                >
                                <input
                                    type="tel"
                                    v-model="form.mobile_no"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :disabled="form.processing"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </section>
                </div>


                <!-- Password -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Password
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                Ensure your account is using a long, random
                                password to stay secure.
                            </p>
                        </header>

                        <form
                            @submit.prevent="updatePassword"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >Current Password</label
                                >
                                <input
                                    type="password"
                                    v-model="passwordForm.current_password"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                            </div>

                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >New Password</label
                                >
                                <input
                                    type="password"
                                    v-model="passwordForm.new_password"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                            </div>

                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >Confirm Password</label
                                >
                                <input
                                    type="password"
                                    v-model="
                                        passwordForm.new_password_confirmation
                                    "
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :disabled="passwordForm.processing"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </BranchManager>
</template>
