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
                            class="relative w-full max-w-md transform overflow-visible rounded-2xl bg-white p-6 shadow-xl transition-all"
                        >
                            <div class="flex flex-col items-center">
                                <!-- Success Icon -->
                                <div class="mb-4 rounded-full bg-green-100 p-2">
                                    <CheckCircle
                                        class="h-8 w-8 text-green-500"
                                    />
                                </div>

                                <!-- Title -->
                                <DialogTitle
                                    as="h3"
                                    class="leading-6 text-gray-900 mb-6"
                                >
                                    <p class="font-semibold text-xl">
                                        Order Received
                                    </p>
                                    <p
                                        class="italic text-gray-700 font-200 text-md"
                                    >
                                        {{ selected[0].ingredient_name }} -
                                        {{ selected[0].quantity }}
                                        {{ selected[0].measurement }}
                                    </p>
                                </DialogTitle>

                                <!-- Date Inputs -->
                                <div class="w-full space-y-6">
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Manufacture Date
                                        </label>
                                        <VueDatePicker
                                            v-model="manufactureDate"
                                            :enable-time-picker="false"
                                            :format="dateFormat"
                                            :max-date="maxManufacturedDate"
                                            text-input
                                            auto-apply
                                            :input-class-name="'dp-custom-input'"
                                            class="w-full date-picker-container"
                                        >
                                            <template #input-icon> </template>
                                        </VueDatePicker>
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Expiration Date
                                        </label>
                                        <VueDatePicker
                                            v-model="expirationDate"
                                            :min-date="minExpirationDate"
                                            :enable-time-picker="false"
                                            :format="dateFormat"
                                            text-input
                                            auto-apply
                                            :input-class-name="'dp-custom-input'"
                                            class="w-full date-picker-container"
                                        >
                                            <template #input-icon> </template>
                                        </VueDatePicker>
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Delivery Date
                                        </label>
                                        <VueDatePicker
                                            v-model="deliveryDate"
                                            :min-date="new Date()"
                                            :max-date = "expirationDate || null"
                                            :enable-time-picker="false"
                                            :format="dateFormat"
                                            text-input
                                            auto-apply
                                            :input-class-name="'dp-custom-input'"
                                            class="w-full date-picker-container"
                                        >
                                            <template #input-icon> </template>
                                        </VueDatePicker>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-8 flex w-full gap-3">
                                    <button
                                        type="button"
                                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        @click="closeModal"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        @click="handleReceive"
                                        type="button"
                                        class="flex-1 items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        :class="{
                                            'bg-gray-400 cursor-not-allowed':
                                                !expirationDate ||
                                                !deliveryDate ||
                                                !manufactureDate,
                                        }"
                                        :disabled="
                                            !expirationDate ||
                                            !deliveryDate ||
                                            !manufactureDate
                                        "
                                    >
                                        <span
                                            class="flex items-center justify-center gap-2"
                                        >
                                            Complete
                                            <CheckIcon class="h-4 w-4" />
                                        </span>
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
import { computed, ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionRoot,
    TransitionChild,
} from "@headlessui/vue";
import { Calendar, CheckCircle, Check as CheckIcon } from "lucide-vue-next";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();
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

const dateFormat = (date) => {
    if (!date) return "";
    const d = new Date(date);
    return `${(d.getMonth() + 1).toString().padStart(2, "0")}/${d
        .getDate()
        .toString()
        .padStart(2, "0")}/${d.getFullYear()}`;
};
const formatDate = (date) => {
    const [year, month, day] = date.split("-"); // Split the date string into year, month, and day
    return `${month}/${day}/${year}`; // Return the formatted date
};
const format_value_date = (date) => {
    const options = { year: "numeric", month: "2-digit", day: "2-digit" };
    return new Date(date).toLocaleDateString("en-US", options);
};

// Emits
const emit = defineEmits(["close", "fetchDeliver"]);

// State
const manufactureDate = ref(null);
const expirationDate = ref(null);
const deliveryDate = ref(formatDate(props.selected[0].delivery_date));

// Methods
const closeModal = () => {
    emit("close");
    // resetForm();
};

const handleReceive = async () => {
    const data = {
        delivery_id: props.selected[0].id,
        manufactured_date: format_value_date(manufactureDate.value),
        expiration_date: format_value_date(expirationDate.value),
        delivery_date: format_value_date(deliveryDate.value),
        status: "Completed",
    };
    try {
        const response = await axios.post(route("inventory.complete.delivery"), {
            ...data,
        });
        if (response.data) {
            $toast.success("Item Received!");
            closeModal();
            emit("fetchDeliver");
            // console.log('Success')
        }
    } catch (error) {
        console.log(error.message);
    }
};

const resetForm = () => {
    manufactureDate.value = null;
    expirationDate.value = null;
    deliveryDate.value = null;
};
const minExpirationDate = computed(() => {
    const date = new Date(deliveryDate.value);
    date.setDate(date.getDate() + 1); // Add one day
    return date;
});
const maxManufacturedDate = computed(() => {
    const date = new Date(deliveryDate.value);
    date.setDate(date.getDate() - 1); // Subtract one day
    return date;
});
</script>

<style scoped>
/* Custom styles for the date picker to match the design */
:deep(.dp__input) {
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    border: 1px solid #d1d5db;
    width: 100%;
}

:deep(.dp__input:focus) {
    outline: 2px solid transparent;
    outline-offset: 2px;
    border-color: #3b82f6;
}
</style>
