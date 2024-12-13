<template>
    <BranchManager>
        <div class="min-h-screen bg-white rounded-md py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            Crew Management
                        </h1>
                        <p class="text-sm text-gray-500">
                            Add and manage crew status with ease.
                        </p>
                    </div>
                    <button
                        @click="isAddModalOpen = true"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <Plus class="h-5 w-5 mr-1" />
                        Add New Crew
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="relative mb-6 md:w-[50%]">
                    <Search
                        class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"
                    />
                    <input
                        type="text"
                        v-model="search"
                        placeholder="Search Crew Member..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Crew Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >   
                    <CrewCard
                        v-for="crew in users"
                        :key="crew.id"
                        :crew="crew"
                    />
                </div>

                <!-- Add Crew Modal -->
                <AddCrewModal
                    :is-open="isAddModalOpen"
                    @close="isAddModalOpen = false"
                />
            </div>
        </div>
    </BranchManager>
</template>
<script setup>
import BranchManager from "../../Layouts/BranchManager.vue";

import { ref, computed } from "vue";
import { Plus, Search } from "lucide-vue-next";
import CrewCard from "./ManageCrewComponents/CrewCard.vue";
import AddCrewModal from "./ManageCrewComponents/AddCrewModal.vue";

const isAddModalOpen = ref(false);
const search = ref("");

defineProps({
    users: {
        type: Array,
    },
});


const filteredCrew = computed(() => {
    const searchTerm = search.value.toLowerCase();
    return crew.value.filter(
        (member) =>
            member.name.toLowerCase().includes(searchTerm) ||
            member.phone.includes(searchTerm) ||
            member.role.toLowerCase().includes(searchTerm)
    );
});

// const removeCrew = (id) => {
//     // Call your backend API to remove the crew member
//     // Example using Inertia:
//     // router.delete(route("crew.destroy", id), {
//     //     preserveScroll: true,
//     // });
// };
</script>
