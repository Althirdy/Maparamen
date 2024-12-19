<template>
    <div class="p-4 border-b border-gray-100 hover:bg-gray-50">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <component
                    :is="icon"
                    class="h-6 w-6 text-gray-400"
                    :class="iconColorClass"
                />
            </div>
            <div class="ml-3 w-0 flex-1 flex flex-col">
                <p class="text-sm font-medium text-gray-900">{{ notification.title }}</p>
                <p class="mt-1 text-sm text-gray-500">{{ notification.description }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { TrendingUp, Package } from "lucide-vue-next";

const props = defineProps({
    notification: {
        type: Object,
        required: true,
    },
});


const icon = computed(() => {
    switch (props.notification.category) {
        case "Bestseller":
            return TrendingUp;
        case "stock":
            return Package;
        default:
            return null;
    }
});

const iconColorClass = computed(() => {
    switch (props.notification.category) {
        case "Bestseller":
            return "text-blue-500";
        case "stock":
            return "text-red-500";
        default:
            return "text-gray-400";
    }
});
</script>
