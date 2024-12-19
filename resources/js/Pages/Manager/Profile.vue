<script setup>
import { ref } from "vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ArrowLeft } from "lucide-vue-next";
import BranchManager from "../../Layouts/BranchManager.vue";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();
const auth = usePage().props.auth;
const mobile_no = ref(auth.user.phone);

const emailForm = useForm({
    email: "jindelacruz@example.com",
});

const passwordForm = ref({
    current_password: "",
    new_password: "",
    new_password_confirmation: "",
});
const errors = ref([]);
const current_password_error = ref();
const updateProfile = async () => {
    try {
        const res = await axios.post(route("Update_Profile"), {
            phone: mobile_no.value,
        });
        if (res.data) {
            $toast.success("Phone No. Updated Successfully");
        }
    } catch (error) {
        console.error(error.message);
    }
};

const updatePassword = async () => {
    try {
        // Reset errors before making a new request
        errors.value = [];

        // Make the API request to update password
        const res = await axios.post(route("update_password"), {
            ...passwordForm.value,
        });
        $toast.success("Password Updated Successfully");
        passwordForm.value = {
            current_password: "",
            new_password: "",
            new_password_confirmation: "",
        };
        current_password_error.value = null
    } catch (error) {
        if (error.response.data) {
            errors.value = error.response.data.errors;
            current_password_error.value = error.response.data.error;
            console.log(current_password_error.value);
        }
    }
};
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
                                    v-model="auth.user.crew_id"
                                    class="mt-1 p-2 border block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    disabled
                                    readonly
                                />
                            </div>

                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >First name</label
                                >
                                <input
                                    type="text"
                                    v-model="auth.user.name"
                                    class="mt-1 p-2 border block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    disabled
                                    readonly
                                />
                            </div>

                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >Mobile no.</label
                                >
                                <input
                                    type="tel"
                                    v-model="mobile_no"
                                    class="mt-1 block w-full p-2 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
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
                                    class="mt-1 p-2 border block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                                <span
                                    class="text-sm text-red-600"
                                    v-if="errors && errors.current_password"
                                    >{{ errors.current_password[0] }}</span
                                >
                                <span
                                    class="text-sm text-red-600"
                                    v-if="current_password_error"
                                    >{{ current_password_error }}</span
                                >
                            </div>

                            <div>
                                <label
                                    class="block font-medium text-sm text-gray-700"
                                    >New Password</label
                                >
                                <input
                                    type="password"
                                    v-model="passwordForm.new_password"
                                    class="mt-1 p-2 border block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                                <span
                                    class="text-sm text-red-600"
                                    v-if="errors && errors.new_password"
                                    >{{ errors.new_password[0] }}</span
                                >
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
                                    class="mt-1 p-2 border block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                />
                                <span
                                    class="text-sm text-red-600"
                                    v-if="
                                        errors &&
                                        errors.new_password_confirmation
                                    "
                                    >{{
                                        errors.new_password_confirmation[0]
                                    }}</span
                                >
                            </div>

                            <div class="flex items-center gap-4">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
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
