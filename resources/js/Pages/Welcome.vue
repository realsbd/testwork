<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import countries from '../Components/countries.json';
// export default {
//   data() {
//     return {
//       fullName: '',
//       email: '',
//       selectedCountry: countries[0],
//       phoneNumber: '',
//       phonePrefix: '',
//       countries,
//     };
//   },
//   methods: {
//     updatePhonePrefix() {
//       this.phonePrefix = `+${this.selectedCountry.code}`;
//     },
//   },
//   mounted()
// };

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>

    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>
        <div>
            <form>
                <div class="block w-1/2">
                    <label for="name" class="text-sky-200">Full Name:</label>
                    <input id="name" type="text"
                        class="w-full my-2 py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
                        v-model="fullName" />
                </div>

                <div class="block w-1/2">
                    <label for="email" class="text-sky-200">Email:</label>
                    <input id="email" type="email"
                        class="w-full my-2 py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
                        v-model="email" />
                </div>

                <div class="block w-1/2">
                    <label for="country" class="text-sky-200">Country:</label>
                    <select id="country" v-model="selectedCountry" @change="updatePhonePrefix">
                        <option v-for="country in countries" :key="country.code" :value="country">
                            {{ country.name }}
                        </option>
                    </select>
                    <!-- <img :src="selectedCountry.flag" :alt="selectedCountry.name" /> -->
                </div>

                <div class="block w-1/2">
                    <label for="phone" class="text-sky-200">Phone Number:</label>
                    <input id="phone" type="tel"
                        class="w-full my-2 py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
                        v-model="phoneNumber" />
                </div>

                <button class="py-2 px-4 bg-blue-500 text-white rounded-lg" @click.prevent="submitForm">Submit</button>
            </form>
        </div>
    </div>
</template>

