<template>
    <div class="grid lg:grid-cols-5 w-full gap-4 max-h-screen overflow-y-auto">
        <Mealcard v-for="meal in meals" :key="meal.id" :meal="meal"  />
    </div>
</template>
<script setup>
import Mealcard from "./Mealcard.vue";
import { category } from "../../Pages/Manager/Util/pos_util";
import { onMounted, ref, watch } from "vue";

const meals = ref([]);


const fetchMeals = async () => {
    try {
        const response = await axios.get(`/meal/${category.value}`);
        meals.value = response.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

onMounted(() => {
    fetchMeals(category.value);
    watch(
        () => category.value,
        (newCategory) => {
            fetchMeals(newCategory.value);
        }
    );
});
</script>
<style>
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
