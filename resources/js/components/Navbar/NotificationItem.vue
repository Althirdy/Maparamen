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
            <div class="ml-3 w-0 flex-1">
                <p class="text-sm font-medium text-gray-900">{{ title }}</p>
                <p class="mt-1 text-sm text-gray-500">{{ message }}</p>
                <p class="mt-1 text-xs text-gray-400">{{ timeAgo }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { TrendingUp, Package } from "lucide-vue-next";

const props = defineProps({
    type: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    message: {
        type: String,
        required: true,
    },
    timeAgo: {
        type: String,
        required: true,
    },
});

const icon = computed(() => {
    switch (props.type) {
        case "trending":
            return TrendingUp;
        case "stock":
            return Package;
        default:
            return null;
    }
});

const iconColorClass = computed(() => {
    switch (props.type) {
        case "trending":
            return "text-blue-500";
        case "stock":
            return "text-red-500";
        default:
            return "text-gray-400";
    }
});
</script>
