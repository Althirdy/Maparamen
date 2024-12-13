<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <!-- Backdrop -->
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-lg bg-white p-6 shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium text-gray-900 mb-4"
                            >
                                Add New Crew Member
                            </DialogTitle>

                            <form @submit.prevent="handleSubmit">
                                <div class="space-y-4">
                                    <!-- Full Name -->
                                    <div>
                                        <label
                                            for="fullName"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Full Name
                                        </label>
                                        <input
                                            id="fullName"
                                            v-model="form.name"
                                            type="text"
                                            required
                                            class="mt-1 block w-full py-2 px-4 rounded-md border-gray-300 border shadow-sm focus:border-green-500 focus:ring-green-500"
                                        />
                                        <p class="text-sm text-red-600">
                                            {{ form.errors.name }}
                                        </p>
                                    </div>

                                    <!-- Phone Number -->
                                    <div>
                                        <label
                                            for="phone"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Phone Number
                                        </label>
                                        <input
                                            id="phone"
                                            v-model="form.phone"
                                            type="tel"
                                            required
                                            placeholder="0934-xxx-xxxx"
                                            class="mt-1 block w-full py-2 px-4 rounded-md border-gray-300 border shadow-sm focus:border-green-500 focus:ring-green-500"
                                        />
                                        <p class="text-sm text-red-600">
                                            {{ form.errors.phone }}
                                        </p>
                                    </div>

                                    <!-- Role -->
                                    <div>
                                        <CustomDropdown
                                            v-model="form.role"
                                            :options="[
                                                {
                                                    value: '2',
                                                    label: 'Kitchen',
                                                },
                                                {
                                                    value: '1',
                                                    label: 'Cashier',
                                                },
                                            ]"
                                            label="Role"
                                            placeholder="Select a role"
                                            required
                                        />
                                        <p class="text-sm text-red-600">
                                            {{ form.errors.role }}
                                        </p>
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <label
                                            for="password"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Password
                                        </label>
                                        <input
                                            id="password"
                                            v-model="form.password"
                                            type="password"
                                            required
                                            class="mt-1 block w-full py-2 px-4 rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                        />
                                        <p class="text-sm text-red-600">
                                            {{ form.errors.password }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        class="w-full rounded-md bg-green-600 px-4 py-2.5 text-lg font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50"
                                    >
                                        {{
                                            form.processing
                                                ? "Adding..."
                                                : "Add Crew"
                                        }}
                                    </button>
                                </div>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import CustomDropdown from "../../../components/CustomDropdown.vue";

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(["close"]);

const form = useForm({
    name: "",
    phone: "",
    role: "",
    password: "",
});

const closeModal = () => {
    emit("close");
};
const roleMapping = {
    Kitchen: 3,
    Cashier: 2,
};
const handleSubmit = () => {
    const originalRole = form.role;

    form.role = roleMapping[form.role] || null;

    form.post(route("crew.store"), {
        onSuccess: () => {
            form.reset();
            closeModal();
        },
        onProgress: () => {
            form.role = originalRole;
        },
        onError: () => {
            form.role = originalRole;

            form.password.reset();
        }
    });
};
</script>
