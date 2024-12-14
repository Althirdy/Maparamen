<script setup>
import { ref, computed, inject } from "vue";
import { ArrowLeftIcon } from "@heroicons/vue/24/outline";
import NumericKeypad from "./NumericKeypad.vue";
import BranchManager from "../../Layouts/BranchManager.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();
const paymentMethod = ref("cash");
const tenderAmount = ref(0);
const gcashReference = ref("");
const applyDiscount = ref(false);
const discountPercent = 20;
const orderType = ref("dine-in");

const cart = inject("useCart");

const orders = cart.orders;

const subtotal = computed(() => {
    return orders.reduce((total, order) => {
        return total + order.meal_price * order.quantity;
    }, 0);
});

const discount = computed(() => {
    if (!applyDiscount.value) return 0;
    return (subtotal.value * discountPercent) / 100;
});

const total = computed(() => {
    return subtotal.value - discount.value;
});

const change = computed(() => {
    const tender = parseFloat(tenderAmount.value) || 0;
    return Math.max(0, tender - total.value);
});

const handleSubmit = async () => {
    try {
        const response = await axios.post(route("pos.store"), {
            paymentMethod: paymentMethod.value,
            orderType: orderType.value,
            tenderAmount: tenderAmount.value,
            gcashReference: gcashReference.value,
            applyDiscount: applyDiscount.value,
            total: total.value,
            change: change.value,
            orders: orders,
        });
        if ((response.data.status = 200)) {
            cart.clearOrders();
            $toast.success("Payment Successfully!", {
                duration: 2000,
                position: "bottom-left",
            });
            setTimeout(() => {
                window.location.href = "/pos"; // Navigate to /pos
            }, 2500);
        }
    } catch (error) {
        console.error("ERROR" + error.message);
    }
};
</script>

<template>
    <BranchManager>
        <div class="min-h-screen bg-white rounded-md">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <Link :href="route('Manager.Pos')">
                    <button
                        class="flex items-center text-gray-600 hover:text-gray-900 mb-2"
                    >
                        <ArrowLeftIcon class="h-5 w-5 mr-2" />
                        Back
                    </button>
                </Link>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Payment Details -->
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h2 class="text-xl font-medium text-gray-900 mb-4">
                                Payment Details
                            </h2>

                            <!-- Tender Amount -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Tender Amount
                                </label>
                                <div class="relative mb-4">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                                        >₱</span
                                    >
                                    <input
                                        type="text"
                                        v-model="tenderAmount"
                                        readonly
                                        class="pl-8 p-3 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm text-xl"
                                    />
                                </div>

                                <!-- Numeric Keypad -->
                                <NumericKeypad v-model:value="tenderAmount" />
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Payment Method
                                </label>
                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-3 border rounded-lg hover:bg-gray-50"
                                    >
                                        <input
                                            type="radio"
                                            v-model="paymentMethod"
                                            value="cash"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500"
                                        />
                                        <span class="ml-2">Cash</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border rounded-lg hover:bg-gray-50"
                                    >
                                        <input
                                            type="radio"
                                            v-model="paymentMethod"
                                            value="gcash"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500"
                                        />
                                        <img
                                            class="h-10 ml-2 rounded-md"
                                            src="https://images.seeklogo.com/logo-png/38/1/gcash-logo-png_seeklogo-383190.png?v=638689904120000000"
                                            alt=""
                                        />
                                        <span class="ml-2">GCash</span>
                                    </label>
                                </div>
                            </div>

                            <!-- GCash Reference Number -->
                            <div v-if="paymentMethod === 'gcash'" class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    GCash Reference Number (Last 4 digits)
                                </label>
                                <input
                                    type="text"
                                    v-model="gcashReference"
                                    maxlength="4"
                                    class="block w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="0000"
                                    style="
                                        appearance: none;
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                    "
                                />
                            </div>
                            <!-- OrderType -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Order Type
                                </label>
                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-3 border rounded-lg hover:bg-gray-50"
                                    >
                                        <input
                                            type="radio"
                                            v-model="orderType"
                                            value="dine-in"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500"
                                        />
                                        <span
                                            class="ml-2 flex items-center gap-2"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide text-gray-500 lucide-disc"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="10"
                                                />
                                                <circle cx="12" cy="12" r="2" />
                                            </svg>
                                            Dine - In</span
                                        >
                                    </label>
                                    <label
                                        class="flex items-center p-3 border rounded-lg hover:bg-gray-50"
                                    >
                                        <input
                                            type="radio"
                                            v-model="orderType"
                                            value="take-out"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500"
                                        />
                                        <span
                                            class="ml-2 flex items-center gap-2"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide text-gray-500 lucide-shopping-bag"
                                            >
                                                <path
                                                    d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"
                                                />
                                                <path d="M3 6h18" />
                                                <path
                                                    d="M16 10a4 4 0 0 1-8 0"
                                                />
                                            </svg>
                                            Take Out</span
                                        >
                                    </label>
                                </div>
                            </div>
                            <!-- Discount Option -->
                            <div class="mb-6">
                                <label
                                    class="flex items-center p-3 border rounded-lg hover:bg-gray-50"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="applyDiscount"
                                        class="h-4 w-4 text-green-600 focus:ring-green-500 rounded"
                                    />
                                    <span class="ml-2"
                                        >Apply {{ discountPercent }}%
                                        Discount</span
                                    >
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Order Summary -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-medium text-gray-900 mb-4">
                            Order Summary
                        </h2>

                        <!-- Order Items -->
                        <div class="divide-y divide-gray-200">
                            <div
                                v-for="order in orders"
                                :key="order.id"
                                class="py-2.5 flex justify-between"
                            >
                                <div>
                                    <span class="font-medium"
                                        >{{ order.quantity }}x</span
                                    >
                                    {{ order.meal_name }}
                                </div>
                                <div
                                    class="text-gray-900 flex items-end flex-col"
                                >
                                    Total: ₱{{
                                        order.meal_price * order.quantity
                                    }}
                                    <p class="text-gray-400 font-200">
                                        ₱ {{ order.meal_price }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Calculations -->
                        <div class="mt-6 space-y-3">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>₱ {{ subtotal }}</span>
                            </div>

                            <div
                                v-if="applyDiscount"
                                class="flex justify-between text-green-600"
                            >
                                <span>Discount ({{ discountPercent }}%)</span>
                                <span>-₱ {{ discount }}</span>
                            </div>

                            <div
                                class="flex justify-between text-lg font-medium border-t border-gray-200 pt-3"
                            >
                                <span>Total</span>
                                <span>₱ {{ total }}</span>
                            </div>

                            <div
                                v-if="change > 0"
                                class="flex justify-between text-lg font-medium text-green-600"
                            >
                                <span>Change</span>
                                <span>₱ {{ change.toFixed(2) }}</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            @click="handleSubmit"
                            class="mt-6 w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50"
                            :disabled="
                                tenderAmount < total ||
                                (paymentMethod === 'gcash' &&
                                    gcashReference.length !== 4)
                            "
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </BranchManager>
</template>
