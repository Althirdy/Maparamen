<template>
    <div
        class="bg-white border-gray-300 border rounded-lg shadow-sm p-4 transition-shadow"
    >
        <!-- Card Header with Date Picker -->
        <div class="flex justify-between items-center mb-4">
            <VueDatePicker
                v-model="date"
                :enable-time-picker="false"
                :format="dateFormat"
                :placeholder="placeholder"
                :range="isRange"
                class="w-[75%] text-xs"
            >
                <template #input-icon>
                    <Calendar class="h-4 w-4 ml-2 text-gray-600" />
                </template>
            </VueDatePicker>

            <button
                v-if="showPrintReport"
                class="text-blue-500 hover:text-blue-600 text-sm"
            >
                Print Report
            </button>
        </div>

        <!-- Sales Amount -->
        <div class="flex justify-between items-end mt-2">
            <div>
                <h3 class="text-3xl font-bold text-gray-900">
                    ₱ {{ formatNumber(amount) }}
                </h3>
                <p class="text-gray-600 text-sm mt-1">{{ title }}</p>
            </div>
            <Coins class="h-6 w-6 text-red-400" />
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { Calendar, Coins } from "lucide-vue-next";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    amount: {
        type: Number,
        required: true,
    },
    isRange: {
        type: Boolean,
        default: false,
    },
    showPrintReport: {
        type: Boolean,
        default: false,
    },
    placeholder: {
        type: String,
        default: "Select date",
    },
    dateFormat: {
        type: String,
        default: "dd/MM/yyyy",
    },
});

const date = ref(null);

const formatNumber = (num) => {
    return new Intl.NumberFormat("en-PH").format(num);
};
</script>
