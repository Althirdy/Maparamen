<template>
    <BranchManager>
        <div class="min-h-screen bg-white rounded-md py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Dashboard Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                    <p class="text-sm text-gray-500">
                        Your sales, inventory, and team overview in one place.
                    </p>
                </div>

                <!-- Sales Cards Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <SalesCard
                        title="Monthly Sales"
                        :amount="480000"
                        :showDatePicker="false"
                    />
                    <SalesCard
                        title="Weekly Sales"
                        :amount="50000"
                        :is-range="true"
                        placeholder="Select date range"
                        :showDatePicker="false"

                    />
                    <SalesCard
                        title="Daily Sales"
                        :amount="2000"
                        placeholder="Today"
                        :show-print-report="true"

                    />
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
                    <!-- Inventory Table (spans 2 columns) -->
                    <div class="lg:col-span-2">
                        <InventoryTable />
                    </div>

                    <!-- Active Crew -->
                    <div>
                        <ActiveCrew />
                    </div>
                </div>
            </div>
        </div>
    </BranchManager>
</template>
<script setup>
import BranchManager from "../../Layouts/BranchManager.vue";
import SalesCard from "./DashboardComponents/SalesCard.vue";
import InventoryTable from "./DashboardComponents/InventoryTable.vue";
import ActiveCrew from "./DashboardComponents/ActiveCrew.vue";
</script>
