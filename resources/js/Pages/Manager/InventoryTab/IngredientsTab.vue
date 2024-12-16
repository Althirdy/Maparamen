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

                <!-- Category -->
                <Listbox v-model="selectedCategory">
                    <div class="relative w-full sm:w-48">
                        <ListboxButton
                            class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                        >
                            <span class="block truncate">
                                {{ categories[selectedCategory - 1].name }}
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

            <!-- Add Item Button -->
            <button
                v-if="auth.user.role == 1"
                class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
                @click="openModal"
            >
                Add Item
            </button>
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
                                    Ingredients ID
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
                                    Status
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Manufactured
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Expiration
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Delivered
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="item in ingredients.data" :key="item.id">
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
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span
                                        :class="[
                                            getStatus(item.quantity, 500) ===
                                            'Critical'
                                                ? 'text-red-600'
                                                : getStatus(
                                                      item.quantity,
                                                      500
                                                  ) === 'Low'
                                                ? 'text-yellow-600'
                                                : 'text-green-600',
                                        ]"
                                    >
                                        {{ getStatus(item.quantity, 500) }}
                                    </span>
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.manufactured_date }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.expiration_date }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ item.delivery_date }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Pagination Controls -->
                    <div class="mt-4 flex justify-between items-center">
                        <!-- Previous Link -->
                        <Link
                            v-if="ingredients.prev_page_url"
                            :href="ingredients.prev_page_url"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                            preserve-scroll
                        >
                            Previous
                        </Link>
                        <span
                            v-else
                            class="px-4 py-2 text-gray-500 cursor-not-allowed"
                            >Previous</span
                        >
                        <span
                            >Page {{ ingredients.current_page }} of
                            {{ ingredients.last_page }}</span
                        >
                        <!-- Next Link -->
                        <Link
                            v-if="ingredients.next_page_url"
                            :href="ingredients.next_page_url"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                            preserve-scroll
                        >
                            Next
                        </Link>
                        <span
                            v-else
                            class="px-4 py-2 text-gray-500 cursor-not-allowed"
                            >Next</span
                        >
                    </div>
                </div>
            </div>
        </div>
        <AddIngredients
            :is-open="isModalOpen"
            @close="closeModal"
            @save="handleSave"
        />
    </div>
</template>
<script setup>
import { ref, watch } from "vue";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import { Link, usePage } from "@inertiajs/vue3";
import axios from "axios";
import AddIngredients from "./AddIngredients.vue";

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
const isModalOpen = ref(false);

const auth = usePage().props.auth;

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const handleSave = (stockData) => {
    console.log(stockData);
    // closeModal();
};
const categories = [
    { id: 1, name: "Dry" },
    { id: 2, name: "Wet" },
    { id: 3, name: "Sauces" },
];
const searchQuery = ref(props.searchQuery || "");
const selectedCategory = ref(props.category_id || categories[0].id);
const ingredients = ref(props.ingredients);

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

const logSearchQuery = () => {
    window.location.href = `/inventory/${selectedCategory.value}/${searchQuery.value}`;
};

watch(searchQuery, (newQuery) => {
    if (newQuery == "") {
        window.location.href = `/inventory/${selectedCategory.value}`;
    }
});

// // Watch for changes in the selectedCategory and trigger the fetch function
watch(selectedCategory, (newCategory) => {
    window.location.href = "/inventory/" + newCategory;
});
</script>
