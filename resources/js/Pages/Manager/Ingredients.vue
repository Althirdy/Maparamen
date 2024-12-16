<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import BranchManager from "../../Layouts/BranchManager.vue";
import IngredientsTab from "./InventoryTab/IngredientsTab.vue";

const props = defineProps({
    ingredients: {
        type: Object,
    },
    category_id: {
        type: String,
    },
    searchQuery: {
        type: String,
        require: false,
    },
});

const activeTab = ref("ingredients");
const tabs = [
    { id: "ingredients", name: "Ingredients" },
    { id: "meals", name: "Meals" },
    { id: "procurement", name: "Procurement (Orders)" },
    { id: "delivery", name: "Delivery" },
    { id: "return", name: "Return" },
];
</script>

<template>
    <Head title="Inventory Management" />
    <BranchManager>
        <div class="p-4 sm:p-6 lg:p-8 bg-white rounded-md min-h-screen">
            <!-- Tabs -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button
                        v-for="tab in tabs"
                        :key="tab.id"
                        @click="activeTab = tab.id"
                        :class="[
                            activeTab === tab.id
                                ? 'border-blue-500 text-primary-600'
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                            'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium',
                        ]"
                    >
                        {{ tab.name }}
                    </button>
                </nav>
            </div>

            <!-- Content -->
            <IngredientsTab
                v-if="activeTab === 'ingredients'"
                :ingredients="ingredients"
                :category_id="category_id"
                :searchQuery="searchQuery"
            />
        </div>
    </BranchManager>
</template>
