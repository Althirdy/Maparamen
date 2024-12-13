<template>
    <div class="bg-white rounded-lg border border-gray-300 shadow-sm p-4">
        <h2 class="text-lg font-semibold mb-4">Active Crew</h2>
        <div class="space-y-4">
            <div
                v-for="member in crew"
                :key="member.id"
                class="flex items-center justify-between"
            >
                <div class="flex items-center">
                    <div
                        class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center"
                    >
                        <User2 class="h-5 w-5 text-gray-500" />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">
                            {{ member.name }}
                        </p>
                        <p class="text-xs text-gray-500">{{ member.role }}</p>
                    </div>
                </div>
                <div class="text-xs text-gray-400">
                    Logged in at {{ member.loginTime }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { User2 } from "lucide-vue-next";

const crew = [
    { id: 1, name: "John Smith", role: "Cashier", loginTime: "08:30 AM" },
    { id: 2, name: "Bob Jhonson", role: "Cashier", loginTime: "09:15 AM" },
];
</script>
