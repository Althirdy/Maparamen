<template>
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Inventory Summary</h2>
            <div class="relative w-[50%]">
                <Search
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"
                />
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="Search..."
                    class="pl-10 w-full pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500">
                        <th class="pb-3 font-medium">Ingredients ID</th>
                        <th class="pb-3 font-medium">Ingredients</th>
                        <th class="pb-3 font-medium">Category</th>
                        <th class="pb-3 font-medium">Quantity</th>
                        <th class="pb-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr
                        v-for="item in inventory"
                        :key="item.id"
                        class="text-sm"
                    >
                        <td class="py-3 text-gray-600">#0000{{ item.id }}</td>
                        <td class="py-3 text-gray-900">
                            {{ item.ingredient_name }}
                        </td>
                        <td class="py-3 text-gray-900">
                            {{ getCategoryClass(item.category_id) }}
                        </td>
                        <td class="py-3 text-gray-600">
                            {{ item.quantity }} pcs.
                        </td>
                        <td class="py-3">
                            <span
                                class="px-3 py-1.5 text-xs rounded-md"
                                :class="getStatusClass(getStatus(item.status))"
                            >
                                {{ getStatus(item.quantity, 500) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Link :href="route('inventory.ingredients')" class="underlined flex gap-2 items-center mt-3 text-xs text-blue-600">View more <ArrowRight :size="16"/></Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import { ArrowRight, Search } from "lucide-vue-next";
import { onMounted, ref, watch } from "vue";

const inventory = ref();
const searchQuery = ref();

const getStatusClass = (status) => {
    switch (status) {
        case "Critical":
            return " text-red-700";
        case "Low":
            return "text-orange-700";
        case "Reorder Soon":
            return " text-yellow-700";
        case "In Stock":
            return " text-green-700";
        default:
            return " text-gray-700";
    }
};

const FetchInventory = async () => {
    let url;
    if (searchQuery.value) {
        url = `/Inventory_Summary/${searchQuery.value}`;
    } else {
        url = route("report.inventory_summary");
    }
    try {
        const res = await axios.get(url);
        if (res.data) {
            inventory.value = res.data;
        }
    } catch (error) {
        console.error(error.message);
    }
};

const getCategoryClass = (category_id) => {
    switch (category_id) {
        case 1:
            return "Dry";
        case 2:
            return "Wet";
        case 3:
            return "Sauces";
        default:
            return "Unknown";
    }
};
const getStatus = (quantity, reorderPoint) => {
    const criticalLevel = reorderPoint * 0.2; // Critical if less than 10% of reorder point
    const lowLevel = reorderPoint * 0.5; // Low if between 10% and 50% of reorder point

    if (quantity <= criticalLevel) {
        return "Critical";
    } else if (quantity <= lowLevel) {
        return "Low";
    } else {
        return "In Stock";
    }
};
watch(searchQuery, () => {
    FetchInventory();
});

onMounted(() => {
    FetchInventory();
});
</script>
