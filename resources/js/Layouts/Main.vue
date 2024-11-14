<script setup>
import { switchTheme } from '../theme';
import NavLink from '../components/NavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const show = ref(false);
</script>

<template>
    <!-- Overlay dropdown so click anywhere on the page and the dropdown disappears -->
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>

    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
            <NavLink routeName="home" componentName="Home">Home</NavLink>

            <div class="flex items-center space-x-6">
                 <div v-if="user" class="relative">
                 <div
                    @click="show = !show"
                    class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-indigo-950 cursor-pointer"
                    :class="{'bg-indigo-950' : show}">
                    <!-- Get the username via usePage and computed in script-->
                    <p>{{ user.name }}</p>
                    <i class="fa-solid fa-angle-down"></i>
                 </div>

                 <!-- Dropdown menu for user-->
                 <div
                    v-show="show"
                    @click="show=false"
                    class="absolute z-50 top-16 right-0
                    bg-indigo-700 text-white rounded-lg
                    border-indigo-700 border overflow-hidden w-40">

                    <Link
                        :href="route('listing.create')"
                        class="block w-full px-6 py-3 hover:bg-indigo-950 text-left">New List Item</Link>

                    <Link
                        :href="route('profile.edit')"
                        class="block w-full px-6 py-3 hover:bg-indigo-950 text-left">Profile</Link>

                    <Link
                        :href="route('dashboard')"
                        class="block w-full px-6 py-3 hover:bg-indigo-950 text-left">Dashboard</Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="block w-full px-6 py-3 hover:bg-indigo-950 text-left">Logout</Link>

                 </div>
                 </div>

                 <!-- If not logged in or registered -->
                 <div v-else class="space-x-6">
                <NavLink routeName="login" componentName="Auth/Login">Login</NavLink>

                <NavLink routeName="register" componentName="Auth/Register">Register</NavLink>
                </div>

                <!-- Dark or light mode -->
                <button @click="switchTheme"
                    class="hover:bg-slate-700 w-6 h-6 grid place-items-center rounded-full hover:outline hover:outline-1 outline-white">
                    <i class="fa-solid fa-lightbulb"></i>
                </button>
            </div>
        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
