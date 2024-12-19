<template>
    <div class="bg-white rounded-lg border border-gray-300 shadow-sm p-4">
        <h2 class="text-lg font-semibold mb-4">Active Crew</h2>
        <div class="space-y-4" v-if="crew_data">
            <div
                v-for="member in crew_data"
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
                        <p class="text-xs text-gray-500">
                            {{ member.role == 2 ? "Cashier" : "Kitchen" }}
                        </p>
                    </div>
                </div>
                <div class="text-xs text-gray-400">
                    Logged in at {{ formatTime(member.updated_at) }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { User2 } from "lucide-vue-next";
import { onMounted, ref } from "vue";

const crew = [
    { id: 1, name: "John Smith", role: "Cashier", loginTime: "08:30 AM" },
    { id: 2, name: "Bob Jhonson", role: "Cashier", loginTime: "09:15 AM" },
];
const crew_data = ref();

const FetchActiveCrew = async () => {
    try {
        const res = await axios.get(route("get_active_crew"));
        if (res.data) {
            crew_data.value = res.data;
        }
    } catch (error) {
        console.error(error.message);
    }
};

const formatTime = (dateStr) => {
    const date = new Date(dateStr); // Convert the string to a Date object
    let hours = date.getHours();
    let minutes = date.getMinutes();
    const ampm = hours >= 12 ? "PM" : "AM";

    // Convert hours from 24-hour format to 12-hour format
    hours = hours % 12;
    hours = hours ? hours : 12; // 12 should be 12, not 0
    minutes = minutes < 10 ? "0" + minutes : minutes; // Ensure two digits for minutes

    return `${hours}:${minutes}${ampm}`;
};

onMounted(() => {
    FetchActiveCrew();
});
</script>
