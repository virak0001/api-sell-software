
<template>
  <div
    class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 h-screen"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <img
          class="mx-auto h-12 w-auto"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt="Workflow"
        />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Signup your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          {{ " " }}
          <a
            href="register"
            class="font-medium text-indigo-600 hover:text-indigo-500"
          >
            Sign in account
          </a>
        </p>
      </div>
      <div class="w-24 h-24 mx-auto">
        <div
          class="
            group
            w-full
            h-full
            rounded-full
            overflow-hidden
            shadow-inner
            text-center
            bg-purple
            table
            cursor-pointer
          "
        >
          <span
            class="
              hidden
              group-hover:table-cell
              text-white
              font-bold
              align-middle
            "
            >KR</span
          >
          <img
            src="https://pickaface.net/gallery/avatar/unr_random_180410_1905_z1exb.png"
            alt="lovely avatar"
            class="
              object-cover object-center
              w-full
              h-full
              visible
              group-hover:hidden
            "
          />
        </div>
      </div>
      <form class="mt-8 space-y-6">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="username" class="sr-only">Username</label>
            <input
              v-model="user.name"
              id="username"
              name="name"
              type="email"
              autocomplete="name"
              required=""
              class="
                appearance-none
                rounded-none
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                rounded-t-md
                focus:outline-none
                focus:ring-indigo-500
                focus:border-indigo-500
                focus:z-10
                sm:text-sm
              "
              placeholder="Username"
            />
          </div>
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input
              v-model="user.email"
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              required=""
              class="
                appearance-none
                rounded-none
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                rounded-t-md
                focus:outline-none
                focus:ring-indigo-500
                focus:border-indigo-500
                focus:z-10
                sm:text-sm
              "
              placeholder="Email address Or Phone number"
            />
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input
              v-model="user.password"
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required=""
              class="
                appearance-none
                rounded-none
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                rounded-b-md
                focus:outline-none
                focus:ring-indigo-500
                focus:border-indigo-500
                focus:z-10
                sm:text-sm
              "
              placeholder="Password"
            />
          </div>
          <div>
            <label for="c_password" class="sr-only">Confirm password</label>
            <input
              v-model="user.c_password"
              id="c_password"
              name="c_password"
              type="c_password"
              autocomplete="current-password"
              required=""
              class="
                appearance-none
                rounded-none
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                rounded-b-md
                focus:outline-none
                focus:ring-indigo-500
                focus:border-indigo-500
                focus:z-10
                sm:text-sm
              "
              placeholder="Password"
            />
          </div>
        </div>
        <div>
          <button
            type="submit"
            @click="register()"
            class="
              group
              relative
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
              bg-indigo-600
              hover:bg-indigo-700
              focus:outline-none
              focus:ring-2
              focus:ring-offset-2
              focus:ring-indigo-500
            "
          >
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            </span>
            Sign up
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
export default {
  data() {
    return {
      user: {
        name: "",
        avatar: "",
        email: "",
        password: "",
        c_password: "",
      },
    };
  },

  methods: {
    async register() {
      try {
        const res = await axios.post("/api/register", this.user);
        if (res && res.data.success) {
          const { token } = res.data.data;
          localStorage.setItem("token", token);
          axios.defaults.headers.common["Authorization"] = token;
          window.location.href = "/";
        }
      } catch (error) {}
    },
  },
};
</script>
