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

            <Listbox v-model="selected_category">
                <div class="relative w-full sm:w-48">
                    <ListboxButton
                        class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                    >
                        <span class="block truncate">
                            {{ selected_category || "All" }}
                        </span>
                        <span
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                        >
                            <ChevronUpDownIcon
                                class="h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                        </span>
                    </ListboxButton>
                    <transition
                        leave-active-class="transition ease-in duration-100"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <ListboxOptions
                            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                        >
                            <ListboxOption
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                                as="template"
                                v-slot="{ active, selected }"
                            >
                                <li
                                    :class="[
                                        active
                                            ? 'text-white bg-indigo-600'
                                            : 'text-gray-900',
                                        'relative cursor-default select-none py-2 pl-3 pr-9',
                                    ]"
                                >
                                    <span
                                        :class="[
                                            selected
                                                ? 'font-semibold'
                                                : 'font-normal',
                                            'block truncate',
                                        ]"
                                    >
                                        {{ category.name }}
                                    </span>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </transition>
                </div>
            </Listbox>
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
                                @click="
                                    auth.user.role === 3
                                        ? openAddStockModal
                                        : null
                                "
                               
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
                                    class="whitespace-nowrap px-3 py-4 text-sm"
                                    :class="{
                                        'text-yellow-800':
                                            item.status === 'To Review',
                                        'text-green-600':
                                            item.status === 'Completed',
                                        'text-red-600':
                                            item.status === 'Returned',
                                    }"
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
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    <button
                                        v-if="
                                            item.status == 'To Receive' ||
                                            (item.status == 'Returned' &&
                                                (auth.user.role == 2 ||
                                                    auth.user.role == 1))
                                        "
                                        class="bg-blue-600 px-3 py-1.5 flex gap-1 items-center rounded-md text-white"
                                        @click="Receive(item.id)"
                                    >
                                        Receive <Check :size="16" />
                                    </button>
                                    <div
                                        v-if="item.status == 'To Review'"
                                        class="flex gap-2"
                                    >
                                        <button
                                            v-if="auth.user.role === 1"
                                            class="border border-green-600 px-2.5 py-1.5 flex gap-1 items-center rounded-md text-gray-900"
                                            @click="handleReturnModal(item.id)"
                                        >
                                            Return
                                        </button>
                                        <button
                                            v-if="
                                                auth.user.role === 1 ||
                                                auth.user.role === 3
                                            "
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
        <AddStockModal
            v-if="auth.user.role === 3"
            :is-open="addStockModal"
            @close="addStockModal = false"
        />
    </div>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import { Check } from "lucide-vue-next";
import { onMounted, ref, watch } from "vue";
import Complete_Modal from "./Complete_Modal.vue";
import Return_Modal from "./Return_Modal.vue";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { ChevronUpDownIcon } from "@heroicons/vue/20/solid";

const categories = [
    { id: null, name: "All" },
    { id: "Completed", name: "Completed" },
    { id: "To Receive", name: "To Receive" },
    { id: "Returned", name: "Returned" },
];

const selected_category = ref(0);
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
    showReturnModal.value = true;
};

const FetchDeliver = async (url) => {
    let link;
    const status = selected_category.value; // Assuming you want to use the category as the status

    // Determine the URL based on search query and selected category
    if (url) {
        link = url;
    } else if (selected_category.value && searchQuery.value) {
        link = `/get_delivery/${status}/${searchQuery.value}`;
    } else if (!selected_category.value && searchQuery.value) {
        link = `/get_delivery/${status}/${searchQuery.value}`; // Use empty string for category
    } else if (selected_category.value && !searchQuery.value) {
        link = `/get_delivery/${status}/`;
    } else {
        link = route("inventory.get.delivery"); // Default route without filters
    }
    try {
        const response = await axios.get(link);
        delivery_data.value = response.data;
    } catch (error) {
        console.log(error.message);
    }
};

watch([searchQuery, selected_category], (sQ, SC) => {
    FetchDeliver();
});

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
