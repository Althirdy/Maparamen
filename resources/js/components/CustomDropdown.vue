<template>
    <div class="relative">
        <label
            v-if="label"
            class="block text-sm font-medium text-gray-700 mb-1"
        >
            {{ label }}
        </label>
        <button
            type="button"
            class="w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            @click="isOpen = !isOpen"
        >
            <span class="block truncate">{{ modelValue || placeholder }}</span>
            <span
                class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
            >
                <svg
                    class="h-5 w-5 text-gray-400 mt-5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </span>
        </button>

        <div
            v-if="isOpen"
            class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
        >
            <div
                v-for="option in options"
                :key="option.value"
                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-blue-50"
                @click="selectOption(option)"
            >
                <span
                    class="block truncate"
                    :class="{ 'font-semibold': option.value === modelValue }"
                >
                    {{ option.label }}
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: "",
    },
    options: {
        type: Array,
        required: true,
    },
    label: {
        type: String,
        default: "",
    },
    placeholder: {
        type: String,
        default: "Select an option",
    },
});

const emit = defineEmits(["update:modelValue"]);
const isOpen = ref(false);

const selectOption = (option) => {
    emit("update:modelValue", option.label);
    isOpen.value = false;
};
</script>
