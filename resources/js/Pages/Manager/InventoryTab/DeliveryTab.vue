<template>
    <div class="mt-6">
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6"
        >
            <div class="flex flex-col sm:flex-row gap-4 w-[50%]">
                <!-- Search -->
                <div class="relative w-full">
                    <input
                        type="text"
                        v-model="searchQuery"
                        placeholder="Search..."
                        class="w-full rounded-md p-2 text-sm pl-4 border border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        @keyup.enter="logSearchQuery"
                    />
                </div>
            </div>

            <!-- Add Item Button -->
        </div>

        <!-- Table -->
        <div class="mt-4 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full px-8 py-2 align-middle">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Order ID
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Ingredients
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Quantity
                                </th>

                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Measurement
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Delivery Date
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Status
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Receive By
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="item in delivery_data.data"
                                :key="item.id"
                            >
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900"
                                >
                                    {{ "00" + item.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.ingredient_name }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.quantity }}
                                </td>

                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.measurement }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ formatDate(item.delivery_date) }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.status }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 flex flex-col text-sm text-gray-700"
                                >
                                    {{ item.user && item.user.name }}
                                    <p>
                                        {{
                                            item.user && getRole(item.user.role)
                                        }}
                                    </p>
                                </td>
                                <td
                                    v-if="auth.user.role == 1"
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    <button
                                        v-if="item.status == 'To Receive'"
                                        class="bg-blue-600 px-3 py-1.5 flex gap-1 items-center rounded-md text-white"
                                        @click="Receive(item.id)"
                                    >
                                        Recieve <Check :size="16" />
                                    </button>
                                    <div
                                        v-if="item.status == 'To Review'"
                                        class="flex gap-2"
                                    >
                                        <button
                                            class="border border-green-600 px-2.5 py-1.5 flex gap-1 items-center rounded-md text-gray-900"
                                            @click="handleReturnModal(item.id)"
                                        >
                                            Return
                                        </button>
                                        <button
                                            @click="
                                                handleCompleteModal(item.id)
                                            "
                                            class="bg-green-600 px-2.5 py-1.5 flex gap-1 items-center rounded-md text-white"
                                        >
                                            Complete
                                        </button>
                                    </div>
                                    <span
                                        v-if="item.status == 'Completed'"
                                        class="text-green-800 flex items-center gap-2"
                                    >
                                        Completed <Check :size="16" />
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Pagination Controls -->
                    <div class="mt-4 flex justify-between items-center">
                        <!-- Previous Link -->
                        <button
                            v-if="delivery_data.prev_page_url"
                            @click="FetchDeliver(delivery_data.prev_page_url)"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                            preserve-scroll
                        >
                            Previous
                        </button>
                        <span
                            v-else
                            class="px-4 py-2 text-gray-500 cursor-not-allowed"
                            >Previous</span
                        >
                        <span
                            >Page {{ delivery_data.current_page }} of
                            {{ delivery_data.last_page }}</span
                        >
                        <!-- Next Link -->
                        <button
                            v-if="delivery_data.next_page_url"
                            @click="FetchDeliver(delivery_data.next_page_url)"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                            preserve-scroll
                        >
                            Next
                        </button>
                        <span
                            v-else
                            class="px-4 py-2 text-gray-500 cursor-not-allowed"
                            >Next</span
                        >
                    </div>
                </div>
            </div>
        </div>
        <Complete_Modal
            v-if="selected_delivery && selected_delivery.length > 0"
            :is-open="showCompleteModal"
            @close="showCompleteModal = false"
            :selected="selected_delivery"
            @fetchDeliver="FetchDeliver"
        />
        <Return_Modal
            v-if="selected_delivery && selected_delivery.length > 0"
            :is-open="showReturnModal"
            :selected="selected_delivery"
            @close="showReturnModal = false"
        />
    </div>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import { Check } from "lucide-vue-next";
import { onMounted, ref } from "vue";
import Complete_Modal from "./Complete_Modal.vue";
import Return_Modal from "./Return_Modal.vue";

const searchQuery = ref("");
const delivery_data = ref([]);
const auth = usePage().props.auth;
const showCompleteModal = ref(false);
const selected_delivery = ref([]);
const showReturnModal = ref(false);

const handleCompleteModal = (id) => {
    const { data } = delivery_data.value;
    selected_delivery.value = data.filter((n) => n.id === id);
    showCompleteModal.value = true;
};

const handleReturnModal = (id) => {
    const { data } = delivery_data.value;
    selected_delivery.value = data.filter((n) => n.id === id);
    showReturnModal.value =true
};

const FetchDeliver = async (url) => {
    const link = url || route("inventory.get.delivery");

    try {
        const response = await axios.get(link);
        delivery_data.value = response.data;
    } catch (error) {
        console.log(error.message);
    }
};
onMounted(() => FetchDeliver());

const Receive = async (id) => {
    try {
        const response = await axios.post(route("inventory.receive.delivery"), {
            delivery_id: id,
            status: "To Review",
        });
        if (response.data) {
            FetchDeliver();
        }
    } catch (error) {
        console.log(error.message);
    }
};

const getRole = (role_id) => {
    let role;
    switch (role_id) {
        case 1:
            role = "Branch Manger";
            break;
        case 2:
            role = "Cashier";
    }
    return role;
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const day = date.getDate().toString().padStart(2, "0");
    const year = date.getFullYear();
    return `${month}/${day}/${year}`;
};
</script>
