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
                                    Category
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
                                    Last Ordered
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
                                v-for="item in procurement_data.data"
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
                                    {{ item.ingredients[0].ingredient_name }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{
                                        Category(
                                            item.ingredients[0].category_id
                                        )
                                    }}
                                </td>

                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.quantity }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.ingredients[0].measurement }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.ingredients[0].delivery_date }}
                                </td>
                                <td
                                    v-if="auth.user.role == 1"
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    <button
                                        @click="HandleRestock(item.id)"
                                        class="bg-blue-600 px-4 py-2 rounded-md text-white"
                                    >
                                        Restock
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Pagination Controls -->
                    <div class="mt-4 flex justify-between items-center">
                        <!-- Previous Link -->
                        <button
                            v-if="procurement_data.prev_page_url"
                            @click="FetchData(procurement_data.prev_page_url)"
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
                            >Page {{ procurement_data.current_page }} of
                            {{ procurement_data.last_page }}</span
                        >
                        <!-- Next Link -->
                        <button
                            v-if="procurement_data.next_page_url"
                            @click="FetchData(procurement_data.next_page_url)"
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
    </div>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, reactive, ref, watch } from "vue";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();

const auth = usePage().props.auth;
const searchQuery = ref();
const procurement_data = ref([]);

// enter in input
// const logSearchQuery = () => {
//     FetchData("", searchQuery.value);
// };

watch(searchQuery, (new_val) => {
    if (!new_val) {
        FetchData();
    } else {
        FetchData("", new_val);
    }
});

const FetchData = async (url, query) => {
    let link = url || "/get_procurement";

    if (query) {
        link = `/get_procurement/${query}`;
    }

    try {
        const response = await axios.get(link);
        procurement_data.value = response.data;
    } catch (err) {
        console.log(err.message);
    }
};

const HandleRestock = async (cat_id) => {
    // console.log(cat_id);
    const selected_proc = procurement_data.value.data.filter(
        (n) => n.id === cat_id
    );
    const data = {
        order_id: selected_proc[0].id,
        ingredient_name: selected_proc[0].ingredients[0].ingredient_name,
        quantity: selected_proc[0].quantity,
        measurement: selected_proc[0].ingredients[0].measurement,
        delivery_date: getNextTuesday(),
    };
    try {
        const response = await axios.post(
            route("inventory.store.procurement"),
            {
                delivery_data: data,
                proc_id: cat_id,
            }
        );
        if (response.data) {
            FetchData();
            $toast.success("Restock Successfully!\nReady to Deliver", {
                duration: 2000,
                position: "bottom-left",
            });
        }
    } catch (error) {
        console.log(error.message);
    }
};

const Category = (category_id) => {
    let category = "";
    switch (category_id) {
        case 1:
            category = "Dry";
            break;
        case 2:
            category = "Wet";
            break;
        case 3:
            category = "Saueces";
            break;
        default:
            category = "unknown";
    }

    return category;
};

onMounted(() => {
    FetchData();
});

const getNextTuesday = () => {
    const today = new Date();
    const dayOfWeek = today.getDay(); // 0 (Sunday) to 6 (Saturday)
    // Calculate days until next Tuesday. If today is Tuesday (dayOfWeek == 2), it should return next week's Tuesday.
    const daysUntilNextTuesday = (2 - dayOfWeek + 7) % 7 || 7; // If today is Tuesday, move to next week's Tuesday
    today.setDate(today.getDate() + daysUntilNextTuesday); // Set the date to next Tuesday
    return today.toISOString().split("T")[0]; // Returns the date in YYYY-MM-DD format
};
</script>
