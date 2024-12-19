<template>
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <img
                            class="h-8 w-auto"
                            src="/public/MapaRamenLogo.png"
                            alt="MapaRamen"
                        />
                        <span class="ml-2 text-xl font-semibold"
                            >Maparamen</span
                        >
                    </div>
                </div>
                <!-- Navigation Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-2">
                    <Link
                        v-for="link in navigationLinks"
                        :key="link.name"
                        :href="route(link.route)"
                        :class="[
                            route().current(link.route)
                                ? 'border-blue-500 text-gray-900'
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                            'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium',
                        ]"
                    >
                        {{ link.name }}
                    </Link>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <NotificationsDropdown v-if="props.userRole == 1" />
                    <UserMenu :user-role="user" />
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Menu v-if="!isMobileMenuOpen" class="block h-6 w-6" />
                        <X v-else class="block h-6 w-6" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div v-if="isMobileMenuOpen" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <Link
                    v-for="link in navigationLinks"
                    :key="link.name"
                    :href="link.route"
                    :class="[
                        route().current(link.route)
                            ? 'bg-blue-50 border-blue-500 text-blue-700'
                            : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700',
                        'block pl-3 pr-4 py-2 border-l-4 text-base font-medium',
                    ]"
                >
                    {{ link.name }}
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import { Braces, Menu, X } from "lucide-vue-next";
import NotificationsDropdown from "./NotificationsDropdown.vue";
import UserMenu from "./UserMenu.vue";

const props = defineProps({
    userRole: {
        type: Number,
        required: true,
    },
});

let user;
switch (props.userRole) {
    case 1:
        user = "Branch Manager";
        break;
    case 2:
        user = "Cashier";
        break;
    case 3:
        user = "Kitchen";
        break;
}

const isMobileMenuOpen = ref(false);

const navigationLinks = computed(() => {
    const links = [{ name: "Dashboard", route: "Manager.Dashboard" }];

    switch (user) {
        case "Branch Manager":
            return [
                { name: "Dashboard", route: "Manager.Dashboard" },
                { name: "POS", route: "Manager.Pos" },
                { name: "Inventory", route: "inventory.ingredients" },
                { name: "Manage Crew", route: "Manager.Crew_manager" },
                { name: "Bad Order", route: "Manager.BadOrder" },
                { name: "Void Order", route: "Manager.VoidOrder" },
            ];
        case "Cashier":
            return [
                // ...links,
                { name: "POS", route: "Manager.Pos" },
                { name: "Void Order", route: "Manager.VoidOrder" },
                { name: "Bad Order", route: "Manager.BadOrder" },
                { name: "Inventory", route: "inventory.ingredients" },

                // { name: "Void / Bad Order", route: "void-orders" },
            ];
        case "Kitchen":
            return [{ name: "Inventory", route: "inventory.ingredients" }];
        default:
            return links;
    }
});
</script>
