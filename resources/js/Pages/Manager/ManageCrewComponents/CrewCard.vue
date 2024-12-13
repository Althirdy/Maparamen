<template>
    <div class="bg-white rounded-lg border border-gray-300 shadow-sm p-4">
        <div class="flex items-center mb-3">
            <div
                class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center"
            >
                <User2 class="h-6 w-6 text-gray-500" />
            </div>
            <div class="ml-3">
                <h3 class="font-medium text-gray-900">{{ crew.name }}</h3>
                <div class="flex items-center text-gray-500 text-sm">
                    <Phone class="h-4 w-4 mr-2" />
                    {{ crew.phone }}
                </div>
                <span class="text-xs text-gray-400 ml-2">
                    Crew Id: {{ crew.crew_id }}
                </span>
            </div>
        </div>

        <div class="flex items-center justify-between border-t pt-2">
            <div class="text-sm text-gray-500">Role: {{ getRoleName(crew.role) }}</div>
            <button
                @click="showConfirmModal = true"
                class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700"
            >
                <Trash2 class="h-4 w-4 mr-1" />
                Remove Crew
            </button>
        </div>

        <ConfirmationModal
            v-model="showConfirmModal"
            :crew-name="crew.name"
            @confirm="handleRemove"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import { User2, Phone, Trash2 } from "lucide-vue-next";
import { router } from "@inertiajs/vue3";
import ConfirmationModal from "./ConfirmationModal.vue";

const props = defineProps({
    crew: {
        type: Object,
        required: true,
    },
});

const showConfirmModal = ref(false);

function getRoleName(role) {
    switch (role) {
        case 1:
            return "Branch Manager";
        case 2:
            return "Cashier";
        case 3:
            return "Kitchen";
        default:
            return "Unknown Role"; // Fallback for unexpected values
    }
}

const handleRemove = () => {
    // router.delete(route("crew.destroy", props.crew.crew_id), {
    //     preserveScroll: true,
    //     onSuccess: () => {
    //         // You can add a success notification here if needed
    //     },
    // });
};

defineEmits(["remove"]);
</script>
