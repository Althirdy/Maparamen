<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-40">
            <!-- Background overlay -->
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
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
                            class="relative w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 shadow-xl transition-all"
                        >
                            <div class="flex flex-col">
                                <!-- Error Icon -->
                                <div
                                    class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100"
                                >
                                    <XCircle class="h-8 w-8 text-red-500" />
                                </div>

                                <!-- Title -->
                                <DialogTitle
                                    as="h3"
                                    class="text-center text-xl font-semibold leading-6 text-gray-900 mb-6"
                                >
                                    Order Return <br>
                                    <span class="italic text-sm">{{ selected[0].ingredient_name }} -
                                    {{ selected[0].quantity }}
                                    {{ selected[0].measurement }}</span>
                                </DialogTitle>

                                <!-- Form -->
                                <div class="mt-2 space-y-6">
                                    <!-- Reason Dropdown -->
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Why you want to return this order?
                                        </label>
                                        <Listbox v-model="selectedReason">
                                            <div class="relative mt-1">
                                                <ListboxButton
                                                    class="relative w-full cursor-pointer rounded-lg bg-white py-3 pl-3 pr-10 text-left border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                >
                                                    <span
                                                        class="block truncate text-gray-700"
                                                        >{{
                                                            selectedReason
                                                        }}</span
                                                    >
                                                    <span
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                                    >
                                                        <ChevronUpDown
                                                            class="h-5 w-5 text-gray-400"
                                                            aria-hidden="true"
                                                        />
                                                    </span>
                                                </ListboxButton>

                                                <transition
                                                    leave-active-class="transition duration-100 ease-in"
                                                    leave-from-class="opacity-100"
                                                    leave-to-class="opacity-0"
                                                >
                                                    <ListboxOptions
                                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                    >
                                                        <ListboxOption
                                                            v-for="reason in reasons"
                                                            :key="reason"
                                                            :value="reason"
                                                            v-slot="{
                                                                active,
                                                                selected,
                                                            }"
                                                            as="template"
                                                        >
                                                            <li
                                                                :class="[
                                                                    active
                                                                        ? 'bg-blue-600 text-white'
                                                                        : 'text-gray-900',
                                                                    'relative cursor-pointer select-none py-2 pl-3 pr-9',
                                                                ]"
                                                            >
                                                                <span
                                                                    :class="[
                                                                        selected
                                                                            ? 'font-semibold'
                                                                            : 'font-normal',
                                                                        'block truncate',
                                                                    ]"
                                                                >
                                                                    {{ reason }}
                                                                </span>

                                                                <span
                                                                    v-if="
                                                                        selected
                                                                    "
                                                                    :class="[
                                                                        active
                                                                            ? 'text-white'
                                                                            : 'text-blue-600',
                                                                        'absolute inset-y-0 right-0 flex items-center pr-4',
                                                                    ]"
                                                                >
                                                                    <Check
                                                                        class="h-5 w-5"
                                                                        aria-hidden="true"
                                                                    />
                                                                </span>
                                                            </li>
                                                        </ListboxOption>
                                                    </ListboxOptions>
                                                </transition>
                                            </div>
                                        </Listbox>
                                    </div>

                                    <!-- Description Textarea -->
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Description
                                        </label>
                                        <textarea
                                            v-model="description"
                                            rows="4"
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Please provide additional details about the return..."
                                        />
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-8 flex gap-3">
                                    <button
                                        type="button"
                                        class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        @click="closeModal"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="button"
                                        class="flex-1 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        @click="handleReturn"
                                    >
                                        Return
                                    </button>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionRoot,
    TransitionChild,
} from "@headlessui/vue";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { XCircle, Check } from "lucide-vue-next";

// Props
const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    selected: {
        type: Array,
        default: () => [], // Default to an empty array if nothing is passed
    },
});

// Emits
const emit = defineEmits(["close"]);

// Return reasons
const reasons = [
    "Damaged Packaging",
    "Wrong Item Received",
    "Defective Product",
    "Other",
];

// State
const selectedReason = ref(reasons[0]);
const description = ref("");

// Methods
const closeModal = () => {
    emit("close");
    resetForm();
};

const handleReturn = () => {
    // emit("submit", {
    //     reason: selectedReason.value,
    //     description: description.value,
    // });
    // resetForm();
};

const resetForm = () => {
    selectedReason.value = reasons[0];
    description.value = "";
};
</script>
