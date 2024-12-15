<template>
    <BranchManager>
        <div class="p-6 bg-white rounded-md">
            <!-- Page Header -->
            <div class="mb-8">
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            Void Orders Today
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Review Void Orders
                        </p>
                    </div>
                </div>

                <!-- Search Bar -->
                <!-- <div class="mt-6 max-w-lg">
                    <div class="relative">
                        <input
                            type="text"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Search orders..."
                            v-model="search"
                        />
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <svg
                                class="h-5 w-5 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- Table -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <div
                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Meal Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Price
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Cashier Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Quantity
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Date
                                        </th>

                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="void_order in props.void"
                                        :key="void_order.id"
                                    >
                                        <td class="pl-6 p-4">
                                            {{
                                                void_order.meals[0]
                                                    ?.meal_name || "N/A"
                                            }}
                                        </td>
                                        <td class="pl-6">
                                            {{
                                                void_order.meals[0]
                                                    ?.meal_price || "N/A"
                                            }}
                                        </td>
                                        <td class="pl-6">
                                            {{
                                                void_order.users[0]?.name ||
                                                "N/A"
                                            }}
                                        </td>
                                        <td class="pl-6">{{ void_order.quantity }}</td>
                                        <td class="pl-6">
                                            {{
                                                formatDate(
                                                    void_order.created_at
                                                )
                                            }}
                                        </td>
                                        <td class="pl-6">
                                            <button
                                                v-if="auth.user.role == 1"
                                                class="bg-red-600 text-white px-3 py-1 rounded"
                                            >
                                                Void Item
                                            </button>
                                            <p v-if="auth.user.role != 1" class="text-red-900">
                                                To Review
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BranchManager>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import BranchManager from "../../Layouts/BranchManager.vue";

const props = defineProps({
    void: {
        type: Array,
    },
});

const auth = usePage().props.auth;

const formatDate = (dateString) => {
    const date = new Date(dateString);
    const options = {
        month: "short", // 'Dec'
        day: "2-digit", // '15'
        year: "numeric", // '2024'
        hour: "2-digit", // '10'
        minute: "2-digit", // '15'
        hour12: true, // Use 12-hour format
    };
    return date.toLocaleString("en-US", options).replace(",", "");
};
</script>
<style lang=""></style>
