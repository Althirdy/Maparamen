<script setup>
import { ref, computed, inject } from "vue";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    XMarkIcon,
    MinusIcon,
    PlusIcon,
    TrashIcon,
} from "@heroicons/vue/24/outline";
import VoidConfirmationModal from "../../components/POS/VoidConfirmationModal.vue";
import { Link } from "@inertiajs/vue3";

const cart = inject("useCart");

const props = defineProps({
    isOpen: Boolean,
});

const emit = defineEmits(["update:isOpen"]);

const isVoidModalOpen = ref(false);
const void_meal_id = ref();

const openVoidModal = (order) => {
    //   selectedOrder.value = order
    void_meal_id.value = order;
    isVoidModalOpen.value = true;
};

const updateQuantity = (order, delta) => {
    const newQuantity = Math.max(0, order.quantity + delta);
    if (newQuantity !== 0) {
        // cart.orders = cart.orders.filter((o) => o.id !== order.id);
        cart.orders = cart.orders.map((item) =>
            item.meal_id === order.meal_id ? { ...item, quantity: newQuantity } : item
        );
    }
};

const subtotal = computed(() => {
    return cart.orders.reduce((total, order) => {
        return total + order.meal_price * order.quantity;
    }, 0);
});

const closeDrawer = () => {
    emit("update:isOpen", false);
};
</script>

<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-50" @close="closeDrawer">
            <TransitionChild
                as="template"
                enter="ease-in-out duration-500"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-500"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-black bg-opacity-30 transition-opacity"
                />
            </TransitionChild>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div
                        class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                    >
                        <TransitionChild
                            as="template"
                            enter="transform transition ease-in-out duration-500"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-500"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel
                                class="pointer-events-auto w-screen max-w-md"
                            >
                                <div
                                    class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl"
                                >
                                    <div
                                        class="flex-1 overflow-y-auto px-4 py-6 sm:px-6"
                                    >
                                        <div
                                            class="flex items-start justify-between"
                                        >
                                            <h2
                                                class="text-lg font-medium text-gray-900"
                                            >
                                                Current Orders
                                            </h2>
                                            <button
                                                type="button"
                                                class="relative -m-2 p-2 text-gray-400 hover:text-gray-500"
                                                @click="closeDrawer"
                                            >
                                                <XMarkIcon class="h-6 w-6" />
                                            </button>
                                        </div>

                                        <div class="mt-8">
                                            <div class="flow-root">
                                                <ul
                                                    role="list"
                                                    class="-my-6 divide-y divide-gray-200"
                                                >
                                                    <li
                                                        v-for="order in cart.orders"
                                                        :key="order.meal_id"
                                                        class="flex py-4"
                                                    >
                                                        <div
                                                            class="flex flex-1 flex-col"
                                                        >
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900"
                                                            >
                                                                <h3>
                                                                    {{
                                                                        `${order.meal_name}`
                                                                    }}
                                                                    <p
                                                                        class="text-gray-700 text-xs"
                                                                    >
                                                                        {{
                                                                            order.meal_category
                                                                        }}
                                                                    </p>
                                                                </h3>
                                                                <p class="ml-4">
                                                                    ₱
                                                                    {{
                                                                        order.meal_price
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <div
                                                                class="flex items-center justify-between mt-2"
                                                            >
                                                                <div
                                                                    class="flex items-center space-x-2"
                                                                >
                                                                    <button
                                                                        @click="
                                                                            updateQuantity(
                                                                                order,
                                                                                -1
                                                                            )
                                                                        "
                                                                        class="rounded-full p-1 text-gray-600 hover:bg-gray-100"
                                                                    >
                                                                        <MinusIcon
                                                                            class="h-4 w-4"
                                                                        />
                                                                    </button>
                                                                    <span
                                                                        class="text-gray-900 w-8 text-center"
                                                                        >{{
                                                                            order.quantity
                                                                        }}</span
                                                                    >
                                                                    <button
                                                                        @click="
                                                                            updateQuantity(
                                                                                order,
                                                                                1
                                                                            )
                                                                        "
                                                                        class="rounded-full p-1 text-gray-600 hover:bg-gray-100"
                                                                    >
                                                                        <PlusIcon
                                                                            class="h-4 w-4"
                                                                        />
                                                                    </button>
                                                                </div>
                                                                <button
                                                                    @click="
                                                                        openVoidModal(
                                                                            order
                                                                        )
                                                                    "
                                                                    class="font-medium text-red-600 hover:text-red-500 flex items-center"
                                                                >
                                                                    <TrashIcon
                                                                        class="h-4 w-4 mr-1"
                                                                    />
                                                                    Void
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="border-t border-gray-200 px-4 py-6 sm:px-6"
                                    >
                                        <div
                                            class="flex justify-between text-base font-medium text-gray-900"
                                        >
                                            <p>Subtotal</p>
                                            <p>₱ {{ subtotal.toFixed(2) }}</p>
                                        </div>
                                        <div class="mt-6">
                                            <Link
                                                :href="route('Manager.Payment')"
                                            >
                                                <button
                                                    class="w-full flex items-center justify-center rounded-md border border-transparent bg-green-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-green-700"
                                                >
                                                    Proceed to payment
                                                </button>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
            <VoidConfirmationModal
                v-model:isOpen="isVoidModalOpen"
                :orderDetails="void_meal_id"
            />
        </Dialog>
    </TransitionRoot>
</template>
