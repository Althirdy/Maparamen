<template>
    <TransitionRoot appear :show="showModal" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-lg bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900 mb-4"
                            >
                                Add Bad Order
                            </DialogTitle>

                            <form
                                @submit.prevent="handleSubmit"
                                class="space-y-4"
                            >
                                <!-- Invoice Number -->
                                <div class="relative">
                                    <!-- Invoice Input with Search -->
                                    <div class="relative">
                                        <input
                                            type="text"
                                            v-model="searchQuery"
                                            @input="handleSearch"
                                            @focus="showSuggestions = true"
                                            placeholder="Invoice No."
                                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all"
                                        />

                                        <!-- Search Suggestions Dropdown -->
                                        <div
                                            v-if="
                                                showSuggestions &&
                                                filteredInvoices.length > 0
                                            "
                                            class="absolute z-50 w-full mt-1 bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto"
                                        >
                                            <div
                                                v-for="invoice in filteredInvoices"
                                                :key="invoice.id"
                                                @click="selectInvoice(invoice)"
                                                class="px-4 py-2 cursor-pointer hover:bg-gray-100 transition-colors"
                                            >
                                                <div
                                                    class="flex justify-between items-center"
                                                >
                                                    <span class="font-medium">{{
                                                        invoice.number
                                                    }}</span>
                                                    <span
                                                        class="text-sm text-gray-500"
                                                        >₱{{
                                                            invoice.amount
                                                        }}</span
                                                    >
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ invoice.date }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Orders Dropdown -->
                                <div>
                                    <label
                                        for="order"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Orders
                                    </label>
                                    <select
                                        id="order"
                                        v-model="formData.order"
                                        class="mt-1 block w-full p-2 border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                        <option value="Maparamen">
                                            Maparamen
                                        </option>
                                        <!-- Add more menu items as needed -->
                                    </select>
                                </div>

                                <!-- Price and Quantity -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            for="price"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Price
                                        </label>
                                        <input
                                            type="text"
                                            id="price"
                                            v-model="formData.price"
                                            class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                            readonly
                                        />
                                    </div>
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
                                            v-model="formData.quantity"
                                            min="1"
                                            class="mt-1 block w-full p-2 border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        />
                                    </div>
                                </div>

                                <!-- Status Dropdown -->
                                <div>
                                    <label
                                        for="status"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Status of Bad Order
                                    </label>
                                    <select
                                        id="status"
                                        v-model="formData.status"
                                        class="mt-1 block w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                        <option value="Replaced">
                                            Replaced
                                        </option>
                                        <option value="Refunded">
                                            Refunded
                                        </option>
                                    </select>
                                </div>

                                <!-- Reason -->
                                <div>
                                    <label
                                        for="reason"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Reason of Return
                                    </label>
                                    <textarea
                                        id="reason"
                                        v-model="formData.reason"
                                        rows="3"
                                        class="mt-1 p-2 border block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    ></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button
                                    type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                >
                                    Save
                                </button>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { computed } from "vue";
// Props for controlling the modal visibility and handling data
const props = defineProps({
    showModal: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(["close", "submit"]);

// Form data state
const formData = ref({
    invoice: "",
    order: "",
    price: "",
    quantity: 1,
    status: "Replaced",
    reason: "",
});

const submitInvoice = () => {
    console.log(formData.value.invoice);
};

// Method to close the modal
const closeModal = () => {
    emit("close");
};

// Method to handle form submission
const handleSubmit = () => {
    emit("submit", { ...formData.value });
    closeModal();
};

const dummyInvoices = [
  { id: 1, number: 'INV-2024-001', amount: '1,299.00', date: 'Jan 15, 2024' },
  { id: 2, number: 'INV-2024-002', amount: '2,499.00', date: 'Jan 14, 2024' },
  { id: 3, number: 'INV-2024-003', amount: '899.00', date: 'Jan 13, 2024' },
  { id: 4, number: 'INV-2024-004', amount: '3,999.00', date: 'Jan 12, 2024' },
  { id: 5, number: 'INV-2024-005', amount: '1,799.00', date: 'Jan 11, 2024' },
]

const searchQuery = ref('')
const showSuggestions = ref(false)

// Filter invoices based on search query
const filteredInvoices = computed(() => {
  if (!searchQuery.value) return dummyInvoices
  const query = searchQuery.value.toLowerCase()
  return dummyInvoices.filter(invoice => 
    invoice.number.toLowerCase().includes(query) ||
    invoice.amount.includes(query)
  )
})

// Handle invoice selection
const selectInvoice = (invoice) => {
  searchQuery.value = invoice.number
  showSuggestions.value = false
  // Emit selected invoice to parent component if needed
  // emit('select-invoice', invoice)
}

// Handle search input
const handleSearch = () => {
  showSuggestions.value = true
}

// Close suggestions when clicking outside (optional)
const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    showSuggestions.value = false
  }
}

// Add click outside listener (optional)
onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})

</script>
