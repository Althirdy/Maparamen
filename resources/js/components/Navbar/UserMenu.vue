<template>
    <div class="relative">
        <button
            @click="isOpen = !isOpen"
            class="flex items-center space-x-2 hover:bg-gray-100 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            <span class="font-medium text-gray-700">{{ userRole }}</span>
        </button>

        <div v-if="isOpen" class="absolute right-0 mt-2 w-48 origin-top-right">
            <!-- Triangle Pointer -->
            <div
                class="absolute right-6 -top-2 h-3 w-3 rotate-45 bg-white"
            ></div>

            <div
                class="relative rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
            >
                <div class="py-1">
                    <Link
                        :href="route('profile')"
                        method="get"
                        as="button"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Profile
                    </Link>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        Logout
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    userRole: {
        type: String,
        required: true,
    },
});

const isOpen = ref(false);
</script>
