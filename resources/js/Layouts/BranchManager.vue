<template>
    <div class="min-h-screen bg-gray-100">
        <Navbar :user-role="auth.user.role" />
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import Navbar from "../components/Navbar/Navbar.vue";

const auth = computed(() => usePage().props.auth);
</script>
