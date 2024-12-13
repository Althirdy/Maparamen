<script setup>
const props = defineProps({
    value: {
        type: Number,
    },
});

const emit = defineEmits(["update:value"]);

const appendNumber = (num) => {
    let newValue = props.value; // Remove any non-numeric characters except decimal point

    // If the current value is 0 or 0.00, start with the number to replace it
    if (!newValue) {
        newValue = num; // Make sure to append as string
    } else {
        newValue += num.toString();
    }

    emit("update:value", newValue); // Emit the updated value as a string
};

const addAmount = (amount) => {
    var currentValue = props.value;
    var newValue;
    if (currentValue == 0) {
        newValue = amount;
    } else {
        newValue= currentValue + amount.toString();
    }
    console.log(newValue)
    emit("update:value", formatNumber(newValue));
};

const RemoveLastNumber = () => {
    let newValue = props.value.toString().slice(0, -1); // Remove the last character
    if (newValue === "") {
        newValue = 0 // If the string is empty, set it to "0"
    }
    emit("update:value",newValue); // Emit the updated value after removing the last number
};

const appendDoubleZero = () => {
    let newValue = props.value; // Remove non-numeric characters
    // if (newValue.includes(".")) {
    //     newValue = newValue.slice(0, newValue.indexOf(".")); // Remove decimal part if already exists
    // }
    newValue += "00";

    emit("update:value", formatNumber(newValue)); // Update the value
};
const formatNumber = (value) => {
    const num = parseInt(value); // Return "0" if the value is not a valid number
    return num; // Return the integer part (without decimals)
};
</script>

<template>
    <div class="grid grid-cols-4 gap-2">
        <button
            v-for="n in 9"
            :key="n"
            @click="appendNumber(n)"
            class="p-4 text-xl font-medium bg-white border rounded-lg hover:bg-gray-50 active:bg-gray-100"
        >
            {{ n }}
        </button>
        <button
            @click="appendDoubleZero"
            class="p-4 text-xl font-medium bg-white border rounded-lg hover:bg-gray-50 active:bg-gray-100"
        >
            00
        </button>
        <button
            @click="addAmount(5)"
            class="p-4 text-xl font-medium bg-green-50 text-green-700 border rounded-lg hover:bg-green-100 active:bg-green-200"
        >
            +5
        </button>
        <button
            @click="addAmount(10)"
            class="p-4 text-xl font-medium bg-green-50 text-green-700 border rounded-lg hover:bg-green-100 active:bg-green-200"
        >
            +10
        </button>
        <button
            @click="appendNumber(0)"
            class="p-4 text-xl font-medium bg-white border rounded-lg hover:bg-gray-50 active:bg-gray-100"
        >
            0
        </button>
        <button
            @click="RemoveLastNumber"
            class="p-4 text-xl font-medium flex justify-center bg-red-50 text-red-700 border rounded-lg hover:bg-red-100 active:bg-red-200"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-delete"
            >
                <path
                    d="M10 5a2 2 0 0 0-1.344.519l-6.328 5.74a1 1 0 0 0 0 1.481l6.328 5.741A2 2 0 0 0 10 19h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"
                />
                <path d="m12 9 6 6" />
                <path d="m18 9-6 6" />
            </svg>
        </button>
        <button
            @click="$emit('update:value', '0.00')"
            class="p-4 text-2xl font-medium bg-red-50 text-red-700 border rounded-lg hover:bg-red-100 active:bg-red-200"
        >
            c
        </button>
    </div>
</template>
