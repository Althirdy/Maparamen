<template>
    <aside
        class="w-64 h-screen bg-white border-r border-gray-200 flex flex-col"
    >
        <!-- Best Seller Section -->
        <!-- <div class="p-4">
            <button
                @click="selectCategory('best-seller')"
                class="w-full flex items-center space-x-3 p-3 rounded-lg transition-colors"
                :class="
                    selectedCategory === 'best-seller'
                        ? 'bg-blue-500 text-white'
                        : 'hover:bg-gray-100'
                "
            >
                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                    />
                </svg>
                <span class="font-medium">Best Seller</span>
                <span class="ml-auto text-sm">10 items</span>
            </button>
        </div> -->

        <!-- Categories List -->
        <div class="flex-1 overflow-y-auto">
            <div class="px-4 space-y-2">
                <button
                    v-for="(category, index) in categories"
                    :key="category.id"
                    @click="selectCategory(category.id)"
                    class="w-full flex items-center border space-x-3 p-4 rounded-lg transition-colors"
                    :class="
                        selectedCategory === category.id
                            ? 'bg-green-600 text-white'
                            : 'hover:bg-gray-100'
                    "
                >
                    <svg
                        v-if="!icons[index]"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                        />
                    </svg>
                    <img
                        v-if="icons[index]"
                        :src="icons[index]"
                        alt="Ramen Icon"
                    />
                    <div class="flex flex-col items-start">
                        <span class="font-medium">{{ category.category }}</span>
                        <span v-if="category.id != 1" class=" text-sm"
                            >{{ category.meals_count }} Meals</span
                        >
                    </div>
                </button>
            </div>
        </div>
    </aside>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import { watch } from "vue";
import { icons } from "./Icons";
import { category, selectCategory } from "../../Pages/Manager/Util/pos_util";

const categories = ref([]);
const selectedCategory = ref(category.value);

const fetchCategories = async () => {
    try {
        const response = await axios.get(route("meal.meal_categories"));
        categories.value = response.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

onMounted(() => {
    fetchCategories();
    watch(category, (newCategory) => {
        selectedCategory.value = newCategory;
    });
});
</script>

<style scoped>
/* Custom scrollbar for categories list */
.overflow-y-auto {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f7fafc;
}

.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f7fafc;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background-color: #cbd5e0;
    border-radius: 3px;
}
</style>
