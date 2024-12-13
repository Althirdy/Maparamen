<script setup>
import { inject, ref } from "vue";
import { Dialog, DialogPanel, DialogTitle } from "@headlessui/vue";
import { ArrowDownTrayIcon } from "@heroicons/vue/24/outline";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    isOpen: Boolean,
    orderDetails: Object,
});

const cart = inject("useCart");

const emit = defineEmits(["update:isOpen"]);

const passcode = ref("");
const error_passcode = ref("");

const $toast = useToast();

const handleVoid = async () => {
    try {
        const response = await axios.post(route("meal.void"), {
            passCode: passcode.value,
            orderDetails: props.orderDetails,
        });
        if (response.data.status == 200) {
            cart.VoidOrder(props.orderDetails);
            $toast.success("Item Voided Successfully", { duration: 2000,position:'bottom-left' });
            closeModal();
        }
    } catch (error) {
        error_passcode.value = error.response.data.message;
    }
};

const handleSaveForReview = async () => {
    // emit('saveForReview', props.orderDetails)
    try{
        const response = await axios.post(route('meal.save_void'),{
            orderDetails: props.orderDetails      
        })
        if(response.data.status == 200){
            cart.VoidOrder(props.orderDetails)
            $toast.success("Item Voided Successfully", { duration: 2000,position:'bottom-left' });
            closeModal();
        }
    }catch(error){
        console.error('Error '+error.message)
    }

};

const closeModal = () => {
    passcode.value = "";
    error_passcode.value = "";
    emit("update:isOpen", false);
};
</script>

<template>
    <Dialog as="div" class="relative z-50" @close="closeModal" :open="isOpen">
        <div class="fixed inset-0 bg-black/30" aria-hidden="true" />

        <div class="fixed inset-0 flex items-center justify-center p-4">
            <DialogPanel class="w-full max-w-md bg-white rounded-lg shadow-xl">
                <div class="p-6">
                    <DialogTitle
                        as="h3"
                        class="text-xl font-medium text-gray-900 border-b border-blue-200 pb-2"
                    >
                        Remove Item
                        <span class="italic text-sm text-gray-700">{{
                            orderDetails.meal_name
                        }}</span>
                    </DialogTitle>

                    <div class="mt-4">
                        <label class="block text-sm text-gray-700 mb-2">
                            Enter Manager Passcode to void order
                        </label>
                        <input
                            type="password"
                            v-model="passcode"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            @keyup.enter="handleVoid"
                        />
                        <p
                            v-if="error_passcode"
                            class="mt-2 text-sm text-red-600"
                        >
                            {{ error_passcode }}
                        </p>
                    </div>

                    <div class="mt-6 flex flex-col space-y-3">
                        <button
                            @click="handleSaveForReview"
                            class="inline-flex items-center justify-center px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                        >
                            <ArrowDownTrayIcon class="w-5 h-5 mr-2" />
                            Save to review later
                        </button>

                        <div class="flex space-x-3">
                            <button
                                @click="closeModal"
                                class="flex-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                            >
                                Cancel
                            </button>
                            <button
                                @click="handleVoid"
                                class="flex-1 px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700"
                            >
                                Void Order
                            </button>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </div>
    </Dialog>
</template>
