<script setup>
import { Dialog, DialogPanel, DialogTitle } from "@headlessui/vue";
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    returnDetails: {
        type: Object,
        required: true,
        default: () => ({
            id: "",
            ingredientName: "",
            category: "",
            deliveryDate: "",
            returnDate: "",
            quantity: "",
            reason: "",
            description: "",
        }),
    },
});

const emit = defineEmits(["close"]);
const formatDate = (date) => {
    const d = new Date(date); // Ensure the input is a Date object
    const month = String(d.getMonth() + 1).padStart(2, "0"); // getMonth() is 0-based
    const day = String(d.getDate()).padStart(2, "0");
    const year = d.getFullYear();

    return `${month}/${day}/${year}`;
};
const handleClose = () => {
    emit("close");
};
</script>

<template>
    <Dialog :open="isOpen" @close="handleClose" class="relative z-50">
        <div class="fixed inset-0 bg-black/30" aria-hidden="true" />

        <div class="fixed inset-0 flex items-center justify-center p-4">
            <DialogPanel
                class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl"
            >
                <div class="flex justify-between items-start mb-6">
                    <DialogTitle class="text-2xl font-bold"
                        >Return Details</DialogTitle
                    >
                    <span class="text-gray-600"
                        >#000{{ returnDetails.id }}</span
                    >
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="font-medium">
                            Ingredient Name:
                            <span class="font-normal">{{
                                returnDetails.ingredient_name
                            }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Delivery Date:
                            <span class="font-normal">{{
                                formatDate(returnDetails.delivery_date)
                            }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Return Date:
                            <span class="font-normal">{{
                                returnDetails.return_date
                            }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Quantity:
                            <span class="font-normal">{{
                                returnDetails.quantity
                            }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Reason of return:
                            <span class="font-normal">{{
                                returnDetails.return_reason
                            }}</span>
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Remarks:
                            <span class="font-normal">{{
                                returnDetails.remarks
                            }}</span>
                        </p>
                    </div>
                </div>

                <button
                    @click="handleClose"
                    class="mt-6 w-full rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2"
                >
                    Close
                </button>
            </DialogPanel>
        </div>
    </Dialog>
</template>
