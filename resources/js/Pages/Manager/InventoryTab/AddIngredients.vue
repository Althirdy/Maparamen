<script setup>
import { computed, ref } from "vue";
import { Dialog, DialogPanel, DialogTitle } from "@headlessui/vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { Calendar } from "lucide-vue-next";

const props = defineProps({
    isOpen: Boolean,
});

const emit = defineEmits(["close", "save"]);

const itemName = ref("");
const quantity = ref(0);
const selectedMeasurement = ref("slices");
const selectedCategory = ref(1);
const manufactureDate = ref(null);
const expirationDate = ref(null);
const deliveryDate = ref(null);

const measurements = [
    "slices",
    "grams",
    "kilograms",
    "pieces",
    "milliliters",
    "liters",
    "packs",
];

const categories_measurements = [
    {
        id: 1,
        category: "Dry",
        measurement: ["(g) grams", "pcs", "slice"],
    },
    {
        id: 2,
        category: "Wet",
        measurement: [
            "cup",
            "pcs",
            "(g) grams",
            "order",
            "(ml) milliliters",
            "cup",
        ],
    },
    {
        id: 3,
        category: "Sauces",
        measurement: ["(ml) milliliters"],
    },
];

const filteredMeasurements = computed(() => {
    const category = categories_measurements.find(
        (category) => category.id === selectedCategory.value
    );
    return category ? category.measurement : [];
});

const categories = ["Dry", "Wet", "Sauce"];

const minDate = new Date();

const closeModal = () => {
    emit("close");
    resetForm();
};

const saveStock = () => {
    emit("save", {
        itemName: itemName.value,
        quantity: quantity.value,
        measurement: selectedMeasurement.value,
        category: selectedCategory.value,
        manufactureDate: manufactureDate.value,
        expirationDate: expirationDate.value,
        deliveryDate: deliveryDate.value,
    });
    // resetForm();
};

const resetForm = () => {
    itemName.value = "";
    quantity.value = 0;
    selectedMeasurement.value = "slices";
    selectedCategory.value = "Dry";
    manufactureDate.value = null;
    expirationDate.value = null;
    deliveryDate.value = null;
};
</script>

<template>
    <Dialog as="div" class="relative z-10" @close="closeModal" :open="isOpen">
        <div class="fixed inset-0 bg-black/25" />

        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <DialogPanel
                    class="w-full max-w-md transform overflow-hidden rounded-md bg-white p-6 shadow-xl transition-all"
                >
                    <DialogTitle
                        as="h3"
                        class="text-2xl font-semibold leading-6 text-gray-900 mb-6"
                    >
                        Add New Stock
                    </DialogTitle>

                    <div class="space-y-4">
                        <!-- Item Name -->
                        <div>
                            <label
                                for="itemName"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Item Name
                            </label>
                            <input
                                type="text"
                                id="itemName"
                                v-model="itemName"
                                class="mt-1 block w-full p-2 border rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <!-- Category -->
                        <div>
                            <label
                                for="category"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Category
                            </label>
                            <select
                                id="category"
                                v-model="selectedCategory"
                                class="mt-1 block border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option
                                    v-for="category in categories_measurements"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.category }}
                                </option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Quantity -->
                            <div>
                                <label
                                    for="quantity"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Quantity
                                </label>
                                <input
                                    type="number"
                                    id="quantity"
                                    v-model="quantity"
                                    min="0"
                                    class="mt-1 p-2 block w-full border rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                            </div>

                            <!-- Measurement -->
                            <div>
                                <label
                                    for="measurement"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Measurement
                                </label>
                                <select
                                    id="measurement"
                                    v-model="selectedMeasurement"
                                    class="mt-1 p-2 border block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option
                                        v-for="(
                                            measurement, index
                                        ) in filteredMeasurements"
                                        :key="index"
                                        :value="measurement"
                                    >
                                        {{ measurement }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Manufacture Date -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >
                                    Manufacture Date
                                </label>
                                <VueDatePicker
                                    v-model="manufactureDate"
                                    :enable-time-picker="false"
                                    :format="'MM/dd/yyyy'"
                                    input-class-name="dp-custom-input"
                                    :teleport="true"
                                >
                                    <template #input-icon>
                                        <Calendar
                                            class="h-4 w-4 ml-2 text-gray-600"
                                        />
                                    </template>
                                </VueDatePicker>
                            </div>

                            <!-- Expiration Date -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >
                                    Expiration Date
                                </label>
                                <VueDatePicker
                                    v-model="expirationDate"
                                    :enable-time-picker="false"
                                    :format="'MM/dd/yyyy'"
                                    input-class-name="dp-custom-input"
                                    :teleport="true"
                                >
                                    <template #input-icon>
                                        <Calendar
                                            class="h-4 w-4 ml-2 text-gray-600"
                                        />
                                    </template>
                                </VueDatePicker>
                            </div>
                        </div>

                        <!-- Delivery Date -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Delivery Date
                            </label>

                            <VueDatePicker
                                v-model="deliveryDate"
                                :enable-time-picker="false"
                                :format="'MM/dd/yyyy'"
                                input-class-name="dp-custom-input"
                                :teleport="true"
                            >
                                <template #input-icon>
                                    <Calendar
                                        class="h-4 w-4 ml-2 text-gray-600"
                                    />
                                </template>
                            </VueDatePicker>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button
                            type="button"
                            class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            @click="closeModal"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            @click="saveStock"
                        >
                            Add Stock
                        </button>
                    </div>
                </DialogPanel>
            </div>
        </div>
    </Dialog>
</template>

<style>
.dp-custom-input {
    width: 100% !important;
    padding: 0.5rem 0.75rem !important;
    border-radius: 0.375rem !important;
    border: 1px solid #d1d5db !important;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05) !important;
}

.dp-custom-input:focus {
    outline: none !important;
    border-color: #6366f1 !important;
    box-shadow: 0 0 0 2px rgb(99 102 241 / 0.2) !important;
}

.dp__menu {
    z-index: 100 !important;
}
</style>
