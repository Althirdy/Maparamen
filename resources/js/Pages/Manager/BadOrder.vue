<template>
    <BranchManager>
        <div class="p-6 bg-white rounded-md">
            <!-- Page Header -->
            <div class="mb-8">
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            Bad Orders
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Review Bad Orders
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <button
                            type="button"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            @click="showAddModal = true"
                        >
                            + Add Bad Order
                        </button>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="mt-6 max-w-lg">
                    <div class="relative">
                        <input
                            type="text"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Search orders..."
                            v-model="search"
                        />
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <svg
                                class="h-5 w-5 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <div
                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Meal Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Price
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Cashier Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Status of Return
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Date
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Reason of Return
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="order in filteredOrders"
                                        :key="order.id"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                        >
                                            {{ order.mealName }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            ₱ {{ order.price.toFixed(2) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ order.cashierName }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                :class="[
                                                    order.status === 'Refunded'
                                                        ? 'text-red-600 bg-red-100'
                                                        : 'text-green-600 bg-green-100',
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                ]"
                                            >
                                                {{ order.status }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ order.date }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ order.reason }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div
                class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4"
            >
                <div class="flex-1 flex justify-between sm:hidden">
                    <button
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                        :disabled="currentPage === 1"
                        @click="currentPage--"
                    >
                        Previous
                    </button>
                    <button
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                        :disabled="currentPage === totalPages"
                        @click="currentPage++"
                    >
                        Next
                    </button>
                </div>
                <div
                    class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                >
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{
                                startIndex + 1
                            }}</span>
                            to
                            <span class="font-medium">{{ endIndex }}</span>
                            of
                            <span class="font-medium">{{ totalItems }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav
                            class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                        >
                            <button
                                v-for="page in totalPages"
                                :key="page"
                                @click="currentPage = page"
                                :class="[
                                    currentPage === page
                                        ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                                        : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                    'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                ]"
                            >
                                {{ page }}
                            </button>
                        </nav>
                    </div>
                </div>
            </div>

            <TransitionRoot appear :show="showAddModal" as="template">
                <Dialog
                    as="div"
                    @close="showAddModal = false"
                    class="relative z-10"
                >
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
                                        <div>
                                            <label
                                                for="invoice"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Invoice No.
                                            </label>
                                            <input
                                                type="text"
                                                id="invoice"
                                                v-model="formData.invoice"
                                                class="mt-1 block p-2 w-full border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                required
                                            />
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
                                                required
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
                                                    class="block text-sm  font-medium text-gray-700"
                                                >
                                                    Quantity
                                                </label>
                                                <input
                                                    type="number"
                                                    id="quantity"
                                                    v-model="formData.quantity"
                                                    min="1"
                                                    class="mt-1 block w-full p-2 border rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                    required
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
                                                required
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
                                                required
                                            ></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <button
                                            type="submit"
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
        </div>
    </BranchManager>
</template>

<script setup>
import { ref, computed } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import BranchManager from "../../Layouts/BranchManager.vue";

const search = ref("");
const showAddModal = ref(false);
const currentPage = ref(1);
const itemsPerPage = 10;

const orders = ref([
    {
        id: 1,
        mealName: "Maparamen",
        price: 99.0,
        cashierName: "John Smith",
        status: "Refunded",
        date: "Nov 10 2024",
        reason: "Overcook TBone",
    },
    {
        id: 2,
        mealName: "Maparamen",
        price: 99.0,
        cashierName: "Bob Jhonson",
        status: "Replaced",
        date: "Nov 10 2024",
        reason: "Incorrect Meals",
    },
    // Add more sample data as needed
]);

const formData = ref({
  invoice: '',
  order: 'Maparamen',
  price: '₱ 99.00',
  quantity: 1,
  status: 'Replaced',
  reason: ''
})

const filteredOrders = computed(() => {
    return orders.value.filter(
        (order) =>
            order.mealName.toLowerCase().includes(search.value.toLowerCase()) ||
            order.cashierName
                .toLowerCase()
                .includes(search.value.toLowerCase()) ||
            order.reason.toLowerCase().includes(search.value.toLowerCase())
    );
});

const totalItems = computed(() => filteredOrders.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage));
const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
const endIndex = computed(() =>
    Math.min(startIndex.value + itemsPerPage, totalItems.value)
);
</script>
