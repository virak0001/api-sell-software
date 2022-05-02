<template>
    <nav class="bg-white shadow-lg full-width sticky">
        <div class="max-w-6x px-4 sticky">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="/" class="flex items-center py-4 px-2">
                            <img src="workflow-mark.svg" alt="Logo" class="h-8 w-8 mr-2" />
                        </a>
                        <a href="/" class="py-4 px-2 ">Coffee list</a>
                    </div>
                </div>
                <div class="flex space-x-7">
                    <div class="hidden md:flex items-center space-x-1">
                        <div class="grid grid-cols-2 divide-x divide-black-500">
                            <a href="login" class="py-4 px-10">Sign in</a>
                            <a href="register" class="py-4 px-2">Create account</a>
                        </div>
                        <a href="" class="py-4 px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-inecap="round" stroke-linejoin="round" stroke-width={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </a>
                        <a href="view-card" class="py-4 px-2 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            0
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from 'axios';
export default {
    data() {
    return {
      auth: {},
     };
    },

    async mounted() {
        await this.getMe()
    },

    methods: {
    async getMe() {
      try {
        const res = await axios.get("/api/me");
        this.auth = res.data
      } catch (error) {}
    },
    }
}
</script>
