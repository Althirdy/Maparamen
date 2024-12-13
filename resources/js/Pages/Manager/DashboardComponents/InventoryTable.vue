<template>
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 ">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Inventory Summary</h2>
        <div class="relative w-[50%]">
          <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" />
          <input
            type="text"
            placeholder="Search..."
            class="pl-10 w-full pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
      </div>
  
      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead>
            <tr class="text-left text-sm text-gray-500">
              <th class="pb-3 font-medium">Ingredients ID</th>
              <th class="pb-3 font-medium">Ingredients</th>
              <th class="pb-3 font-medium">Quantity</th>
              <th class="pb-3 font-medium">Status</th>
              <th class="pb-3 font-medium">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-for="item in inventory" :key="item.id" class="text-sm">
              <td class="py-3 text-gray-600">#{{ item.id }}</td>
              <td class="py-3 text-gray-900">{{ item.name }}</td>
              <td class="py-3 text-gray-600">{{ item.quantity }} pcs.</td>
              <td class="py-3">
                <span 
                  class="px-2 py-1 text-xs rounded-full"
                  :class="getStatusClass(item.status)"
                >
                  {{ item.status }}
                </span>
              </td>
              <td class="py-3">
                <button class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-1 rounded-md text-sm">
                  View
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script setup>
  import { Search } from 'lucide-vue-next'
  
  const inventory = [
    { id: '45169', name: 'Aonori', quantity: 5, status: 'Critical' },
    { id: '18933', name: 'Beef Gyudon', quantity: 5, status: 'Critical' },
    { id: '20462', name: 'Bagnet', quantity: 20, status: 'Low' },
    { id: '20462', name: 'Chicken Bone', quantity: 30, status: 'Reorder Soon' },
    { id: '20462', name: 'Chicken Wings', quantity: 120, status: 'In Stock' }
  ]
  
  const getStatusClass = (status) => {
    switch (status) {
      case 'Critical':
        return 'bg-red-100 text-red-700'
      case 'Low':
        return 'bg-orange-100 text-orange-700'
      case 'Reorder Soon':
        return 'bg-yellow-100 text-yellow-700'
      case 'In Stock':
        return 'bg-green-100 text-green-700'
      default:
        return 'bg-gray-100 text-gray-700'
    }
  }
  </script>