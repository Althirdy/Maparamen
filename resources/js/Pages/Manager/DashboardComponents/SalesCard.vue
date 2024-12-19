<template>
    <div
        class="bg-white border-gray-300 border flex flex-col justify-end rounded-lg shadow-sm p-4 transition-shadow"
    >
        <!-- Card Header with Date Picker -->
        <div class="flex justify-between items-center mb-4">
            <VueDatePicker
                v-if="showDatePicker"
                v-model="date"
                :enable-time-picker="false"
                :format="'yyyy-MM-dd'"
                :placeholder="placeholder"
                :range="isRange"
                auto-apply
                class="w-[75%] text-xs"
            >
                <template #input-icon>
                    <Calendar class="h-4 w-4 ml-2 text-gray-600" />
                </template>
            </VueDatePicker>

            <button
                v-if="showPrintReport"
                class="text-blue-500 hover:text-blue-600 text-sm"
                @click="printReport"
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
import { ref, watch } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { Calendar, Coins } from "lucide-vue-next";
import axios from "axios";
import { format } from "date-fns";

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
    showDatePicker: {
        type: Boolean,
        default: true,
    },
    daily_date: {
        type: String,
        required: false
    }
});

const date = ref(props.daily_date || format(new Date(), "yyyy-MM-dd"));

const emits = defineEmits(["select_date"]);

const formatNumber = (num) => {
    return new Intl.NumberFormat("en-PH").format(num);
};

watch(date, (newDate) => {
    emits("select_date", newDate);
});
const printReport = async () => {
    try {
        // Format the date as 'YYYY-MM-DD' (extract date part only)
        const selectedDate = date.value
            ? new Date(date.value).toISOString().split("T")[0]
            : new Date().toISOString().split("T")[0]; // Fallback to today's date

        // Log the selected date for debugging
        console.log("Formatted Date:", selectedDate);

        // Send the formatted date to the backend
        const response = await axios.get(
            route("Manager.report", { date: selectedDate }),
            {
                responseType: "blob", // Important for PDF
            }
        );

        // Create a Blob object and open the PDF
        const fileURL = window.URL.createObjectURL(new Blob([response.data]));
        window.open(fileURL);

        // Optional: Directly trigger a download
        // const link = document.createElement('a');
        // link.href = fileURL;
        // link.setAttribute('download', 'success_orders_report.pdf');
        // document.body.appendChild(link);
        // link.click();
    } catch (error) {
        console.error("Error generating the report:", error);
    }
};
</script>
