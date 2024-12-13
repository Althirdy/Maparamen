<template>
    <BranchManager>
        <div>
            <div class="min-h-screen bg-white rounded-md py-6">
                <div class="max-w-7xl mx-auto flex gap-4 px-4 sm:px-6 lg:px-4">
                    <CategorySidebar />
                    <div class="flex flex-col gap-4 items-end w-full">
                        <button
                            @click="isOrdersOpen = true"
                            v-if="cart.orders.length != 0"
                            className="bg-green-700 gap-2 border-none px-4 flex items-center text-white py-2 rounded-md"
                        >
                            View {{ cart.orders.length }} Orders
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-shopping-cart"
                            >
                                <circle cx="8" cy="21" r="1" />
                                <circle cx="19" cy="21" r="1" />
                                <path
                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"
                                />
                            </svg>
                        </button>
                        <MealList />
                    </div>
                </div>
            </div>
            <OrdersDrawer v-model:isOpen="isOrdersOpen" />
        </div>
    </BranchManager>
</template>
<script setup>
import { inject, ref } from "vue";
import BranchManager from "../../Layouts/BranchManager.vue";
import CategorySidebar from "../../components/POS/CategorySidebar.vue";
import MealList from "../../components/POS/MealList.vue";
import OrdersDrawer from "../../components/POS/OrdersDrawer.vue";
const isOrdersOpen = ref(false);

const cart = inject("useCart");
</script>
