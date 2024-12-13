<template>
    <div
        class="p-2 border rounded-md relative cursor-pointer"
        @click="cart.addOrder({ ...meal_cart, quantity: 1 })"
    >
        <div v-if="meal_in_cart" class="absolute text-md bg-blue-600 h-10 w-10 flex items-center justify-center text-white font-medium shadow-lg right-2 rounded-full">
            {{ meal_in_cart.quantity }}
        </div>
        <img
            class="rounded-md"
            :src="`/meals_img/${meal.meal_image}`"
            :alt="meal.meal_name"
        />
        <div class="text-start">
            <h3 class="text-gray-900 text-lg font-medium">
                {{ meal.meal_name }}
            </h3>
            <p class="text-lg text-gray-600">₱ {{ meal.meal_price }}</p>
        </div>
    </div>
</template>

<script setup>
import { computed, inject } from "vue";

const props = defineProps({
    meal: {
        type: Object,
        required: true,
    },
});

const meal_cart = {
    meal_id: props.meal.id,
    meal_name: props.meal.meal_name,
    meal_price: props.meal.meal_price,
    meal_category: props.meal.category.category
};

const cart = inject("useCart");
const meal_in_cart = computed(() => 
  cart.orders.find((n) => n.meal_id == props.meal.id)
);
</script>
