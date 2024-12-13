<template>
    <div
        class="min-h-screen bg-gray-100 flex p-6 flex-col justify-center py-12 sm:px-6 lg:px-8"
    >
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="sm:mx-auto mb-2 sm:w-full sm:max-w-md">
                    <img
                        src="/public/MapaRamenLogo.png"
                        alt="MapaRamen Logo"
                        class="mx-auto h-24 w-auto"
                    />
                    <h2
                        class="text-center mt-4 text-3xl font-bold text-gray-900"
                    >
                        MapaRamen
                    </h2>
                    <p class="text-center text-sm text-gray-600">
                        Caloocan North [Saranay Branch]
                    </p>
                </div>
                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div>
                        <CustomDropdown
                            v-model="form.role"
                            :options="roleOptions"
                            label="Sign in as:"
                            placeholder="Select role"
                        />
                        <p class="text-sm text-red-600">
                            {{ form.errors.role }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="crewId"
                            class="block text-sm font-medium text-gray-500"
                        >
                            Crew ID
                        </label>
                        <div class="mt-1">
                            <input
                                id="crewId"
                                v-model="form.crew_id"
                                type="text"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            />
                        </div>
                        <p class="text-sm text-red-600">
                            {{ form.errors.crew_id }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-500"
                        >
                            Password
                        </label>
                        <div class="mt-1">
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            />
                        </div>
                    </div>
                    <p class="text-sm text-red-600">{{ form.errors.error }}</p>
                    <div>
                        <button
                            type="submit"
                            :disabled="processing"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
                        >
                            {{ processing ? "Logging in..." : "Login" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import CustomDropdown from "@/components/CustomDropdown.vue";

const roleOptions = [
    { value: "3", label: "Kitchen" },
    { value: "1", label: "Branch Manager" },
    { value: "2", label: "Cashier" },
];

const form = useForm({
    role: "",
    crew_id: "",
    password: "",
});

const processing = ref(false);

const handleSubmit = () => {
    processing.value = true;
    form.post(route("login"), {
        onError: () => {
            form.password = "";
        },
        onFinish: () => {
            processing.value = false;
        },
    });
};
</script>
