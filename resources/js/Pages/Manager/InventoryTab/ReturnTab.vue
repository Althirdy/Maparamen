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
                                    Ingredient
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
                                    Return Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="item in return_data.data"
                                :key="item.id"
                                class="hover:bg-gray-100"
                                @click="openDialog(item.id)"
                            >
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900"
                                >
                                    {{
                                        // categories[item.category_id].name.slice(
                                        //     0,
                                        //     1
                                        // ) +
                                        "00" + item.id
                                    }}
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
                                    {{ item.return_date }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Pagination Controls -->
                </div>
            </div>
        </div>
    </div>
    <ReturnDetails_Modal
        v-if="selected_inventory && selected_inventory.length > 0"
        :is-open="isDialogOpen"
        :return-details="selected_inventory[0]"
        @close="closeDialog"
        @fetchReturn="fetchReturn"
    />
</template>
<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import ReturnDetails_Modal from "./ReturnDetails_Modal.vue";

const searchQuery = ref("");
const return_data = ref([]);
const isDialogOpen = ref(false);
const selected_inventory = ref([]);

const openDialog = (id) => {
    selected_inventory.value = return_data.value.data.filter(
        (n) => n.id === id
    );
    isDialogOpen.value = true;
};

const closeDialog = () => {
    isDialogOpen.value = false;
};

const fetchReturn = async () => {
    try {
        const res = await axios.get(route("intenvory.get.return"));
        if (res.data) {
            return_data.value = res.data;
            console.log(return_data.value);
        }
    } catch (error) {
        console.log(error.message);
    }
};

onMounted(() => {
    fetchReturn();
});

const logSearchQuery = () => {
    console.log(searchQuery.value);
};
</script>
