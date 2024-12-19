<template>
    <div class="relative z-10">
        <button
            @click="isOpen = !isOpen"
            class="relative p-1 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            <span class="sr-only">View notifications</span>
            <Bell class="h-6 w-6" />
            <span
                v-if="notif_data.length"
                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"
            />
        </button>

        <div v-if="isOpen" class="absolute right-0 mt-2 w-80 origin-top-right">
            <!-- Triangle Pointer -->
            <div
                class="absolute right-6 -top-2 h-3 w-3 rotate-45 bg-white"
            ></div>

            <div
                class="relative rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
            >
                <div class="p-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Notifications
                    </h2>
                    <p class="text-sm text-gray-500">
                        Recent alerts and order updates
                    </p>
                </div>

                <div class="max-h-96 overflow-y-auto">
                    <NotificationItem
                        v-for="notification in notif_data"
                        :key="notification.id"
                        v-bind="notification"
                        :notification="notification"
                    />
                </div>

                <div
                    v-if="!notif_data.length"
                    class="p-4 text-center text-gray-500"
                >
                    No new notifications
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { Bell } from "lucide-vue-next";
import NotificationItem from "./NotificationItem.vue";
import axios from "axios";

const isOpen = ref(false);
const notif_data = ref([]);

const fetchNotif = async () => {
    try {
        const res = await axios.get(route("get_notification"));
        notif_data.value = res.data;
        console.log(notif_data.value);
    } catch (error) {
        console.error(error.message);
    }
};

onMounted(() => {
    fetchNotif();
});
</script>
