<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-white">
    <div
      class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8"
    >
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <h1 class="text-center font-medium">Your card view</h1>
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="
                shadow
                overflow-hidden
                border-b border-gray-200
                sm:rounded-lg
              "
            >
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Name
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      quantity
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Description
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Sub total
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="card in cardList" :key="card.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img
                            :src="card.image_url"
                            alt=""
                            class="w-full h-full object-center object-cover"
                          />
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            {{ card.name }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500">
                        {{ card.quantity }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ card.description }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap  text-sm text-gray-500"
                    >
                      {{ card.subTotalPrice }}
                    </td>
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-right text-sm
                        font-medium
                      "
                    >
                      <a href="#" class="text-indigo-600 hover:text-indigo-900"
                        >Edit</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
              <button @click="confirmOrder()" class="bg-blue-500 hover:bg-blue-700 float-right text-white font-bold py-2 px-4 border border-blue-700 rounded">
              ORDER CONFIRM
              </button>
              <h1 class="text-center font-medium">Your order success</h1>
              <div
              class="
                shadow
                overflow-hidden
                border-b border-gray-200
                sm:rounded-lg
              "
            >
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Name
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      quantity
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Description
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                      "
                    >
                      Sub total
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="card in successItem" :key="card.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img
                            :src="card.image_url"
                            alt=""
                            class="w-full h-full object-center object-cover"
                          />
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            {{ card.name }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500">
                        {{ card.quantity }}
                      </div>
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap  text-sm text-gray-500"
                    >
                      {{ card.subTotalPrice }}
                    </td>
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-right text-sm
                        font-medium
                      "
                    >
                      <a href="#" class="text-indigo-600 hover:text-indigo-900"
                        >Edit</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
            <div v-if="showModal" class="overflow-x-hidden backdrop-opacity-5 overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex bg-gray-50 opacity-80">
              <payment @cancel="cancel()" />
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      cardList: {},
      successItem: {},
      showModal: false,
      auth: {},
    };
  },
  async mounted() {
    await this.getCards();
    await this.getMe()
    await this.getOrderSucess()
  },
  methods: {
    async getCards() {
      const res = await axios.get("/api/card-items");
      this.cardList = res.data.data;
    },
    cancel() {
      this.showModal = false
    },
    async getOrderSucess() {
      const res = await axios.get("/api/orders");
      this.successItem =  res.data.data;
    },
    confirmOrder() {
      // if(this.auth.customer_id) {
        // axios.post('/api/orders', {})
      // } else {
        this.showModal = true
      // }
    },
    async getMe() {
      try {
        const res = await axios.get("/api/me");
        this.auth = res.data
      } catch (error) {}
    },
  },
};
</script>
