<script setup>
import { ref } from "vue";
import { Dialog, DialogPanel, DialogTitle } from "@headlessui/vue";
import { defineProps, defineEmits } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    selected_ingredients: {
        type: Array,
    },
});

const emit = defineEmits(["close"]);

const formData = ref({
    itemName: props.selected_ingredients[0].ingredient_name || "",
    quantity: 0,
    measurement: props.selected_ingredients[0].measurement || "",
    manufactureDate: props.selected_ingredients[0].manufactured_date || "",
    expirationDate: props.selected_ingredients[0].expiration_date || "",
    deliveryDate: props.selected_ingredients[0].delivery_date || "",
});

const handleSubmit = async () => {
    try {
        const res = await axios.post(route("inventory.update.stock"), {
            ...formData.value,
            id: props.selected_ingredients[0].id,
        });
        if (res.data) {
            $toast.success("Ingredient Successfully updated");
            window.location.href = "/inventory";
            handleClose();
        }
    } catch (error) {
        console.error(error.message);
    }
};

const handleClose = () => {
    emit("close");
    const formData = ref({
        itemName: "",
        quantity: 0,
        measurement: "",
        manufactureDate: "",
        expirationDate: "",
        deliveryDate: "",
    });
};
const dateFormat = (date) => {
    if (!date) return "";
    const d = new Date(date);
    return `${(d.getMonth() + 1).toString().padStart(2, "0")}/${d
        .getDate()
        .toString()
        .padStart(2, "0")}/${d.getFullYear()}`;
};
</script>

<template>
    <Dialog :open="isOpen" @close="handleClose" class="relative z-50">
        <div class="fixed inset-0 bg-black/30" aria-hidden="true" />

        <div class="fixed inset-0 flex items-center justify-center p-4">
            <DialogPanel
                class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl"
            >
                <DialogTitle class="text-2xl font-semibold mb-6"
                    >Add New Stock</DialogTitle
                >

                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div>
                        <label
                            for="itemName"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Item Name
                        </label>
                        <input
                            id="itemName"
                            v-model="formData.itemName"
                            type="text"
                            readonly
                            disabled
                            class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                for="quantity"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Quantity
                            </label>
                            <input
                                id="quantity"
                                v-model="formData.quantity"
                                type="number"
                                min="0"
                                required
                                class="w-full p-2 border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>

                        <div>
                            <label
                                for="measurement"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Measurement
                            </label>
                            <input
                                id="measurement"
                                v-model="formData.measurement"
                                type="text"
                                readonly
                                disabled
                                class="w-full rounded-md p-2 border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Manufactured Date
                            </label>
                            <VueDatePicker
                                v-model="formData.manufactureDate"
                                :max-date="formData.deliveryDate || null"
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
                                Expiration Date
                            </label>
                            <VueDatePicker
                                v-model="formData.expirationDate"
                                :min-date="formData.deliveryDate"
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

                    <div>
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Delivery Date
                            </label>
                            <VueDatePicker
                                v-model="formData.deliveryDate"
                                :min-date="new Date()"
                                :max-date="formData.expirationDate || null"
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

                    <div class="flex gap-4 pt-4">
                        <button
                            type="button"
                            @click="handleClose"
                            class="flex-1 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Cancel
                        </button>
                        <button
                            :disabled="formData.quantity <= 0"
                            type="submit"
                            class="flex-1 rounded-md border border-transparent bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            :class="{
                                'cursor-not-allowed opacity-50':
                                    formData.quantity <= 0,
                            }"
                        >
                            Add Stock
                        </button>
                    </div>
                </form>
            </DialogPanel>
        </div>
    </Dialog>
</template>
