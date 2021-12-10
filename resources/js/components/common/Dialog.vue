<template>
    <div>
        <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DialogProductDetail",
    props: {
        showModal: {
            types: Boolean,
            default: true
        }
    },
    methods: {
        toggleModal: function(){
            this.showModal = !this.showModal;
        }
    }
}
</script>
