<template>
  <div class="bg-white">
    <div
      class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8"
    >
      <h1 class="text-center text-4xl">Conffe Lists</h1>
      <div
        class="
          grid grid-cols-1
          gap-y-10
          sm:grid-cols-2
          gap-x-6
          lg:grid-cols-3
          xl:grid-cols-4 xl:gap-x-8
        "
      >
        <a
          v-for="product in products"
          :key="product.id"
          :href="product.href"
          class="group"
          @click="openProductDetail(product.id)"
        >
          <div
            class="
              aspect-w-1 aspect-h-1
              rounded-lg
              overflow-hidden
              xl:aspect-w-7 xl:aspect-h-8
            "
          >
            <img
              :src="product.image_url"
              :alt="product.imageAlt"
              class="w-full h-full object-center object-cover mx-auto"
            />
          </div>
          <h3 class="t-1 text-lg font-medium text-green-900">
            {{ product.name }}
          </h3>
          <p class="mt-1">Pirice: {{ product.price }}</p>
          <p class="mt-1">Description: {{ product.description }}</p>
          <button
            @click.stop="addToCard(product.id)"
            class="
              group
              w-full
              flex
              justify-center
              py-2
              px-4
              border border-transparent
              text-sm
              font-medium
              rounded-md
              text-white
              bg-green-600
            "
          >
            <span class="left-0 inset-y-0 flex items-center pl-3">
            </span>
            Add to card
          </button>
        </a>
      </div>
    </div>
    <ProductDetailDialog :value="showModal" @toggleModal="closeDialog" />
  </div>
</template>
<script lang="ts">
import axios from "axios";
import ProductDetailDialog from "../components/common/ProductDetailDialog.vue";
export default {
  components: { ProductDetailDialog },
  data() {
    return {
      showModal: false,
      products: {},
      upload: "upload/",
    };
  },

  async mounted() {
    await this.getProducts();
  },

  methods: {
    openProductDetail() {
      this.showModal = true;
    },
    closeDialog() {
      this.showModal = false;
    },
    async getProducts() {
      const res = await axios.get("/api/products");
      this.products = res.data.data;
    },
    async addToCard(id) {
        const card = {
            product_id: id,
            quantity: 1
        }
        const res = await axios.post("/api/card-items", card);
        if(res.data) {
            alert('Add item to card success')
        }
    }
  },
};
</script>
