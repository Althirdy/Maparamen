import { onMounted, reactive } from "vue";

const cartState = reactive({
    orders: JSON.parse(localStorage.getItem("cartOrders")) || [],

    addOrder(order) {
        const existingOrder = this.orders.find(
            (prev) => prev.meal_id === order.meal_id
        );
        if (existingOrder) {
            existingOrder.quantity += order.quantity;
        } else {
            this.orders = [...this.orders, order];
        }
        localStorage.setItem("cartOrders", JSON.stringify(this.orders));
    },
    clearOrders() {
        this.orders = [];
        localStorage.removeItem("cartOrders");
    },

    VoidOrder(order) {
        this.orders = this.orders.filter(
            (prev) => prev.meal_id !== order.meal_id
        );
        localStorage.setItem("cartOrders", JSON.stringify(this.orders));
    },
});

export default function useCart() {
    return cartState;
}
