<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen">
            <nav>
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto border-b border-[#006f89] px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link v-if="$page.props.auth.user.is_japanese==1" :href="route('mypage')">
                                    <div class="flex items-center">
                                        <ApplicationLogo
                                            class="block h-12 w-auto fill-current text-gray-800"
                                        />
                                        <span class="text-2xl text-[#006f89] font-logo font-bold ml-2">Travel Matching</span>
                                    </div>
                                </Link>
                                <Link v-else :href="route('foreign.mypage')">
                                    <div class="flex items-center">
                                        <ApplicationLogo
                                            class="block h-12 w-auto fill-current text-gray-800"
                                        />
                                        <span class="text-2xl text-[#006f89] font-logo font-bold ml-2">Travel Matching</span>
                                    </div>
                                </Link>
                            </div>
                        </div>

                        <div class="hidden lg:flex lg:items-center lg:ml-6">
                            <!-- Navigation Links -->
                            <div class="hidden lg:-my-px lg:ml-10 lg:flex">
                                <NavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('mypage')" :active="route().current('mypage') || route().current('profile.edit')">
                                    マイページ
                                </NavLink>
                                <NavLink v-else :href="route('foreign.mypage')" :active="route().current('foreign.mypage') || route().current('foreign.profile.edit')">
                                    Mypage
                                </NavLink>
                            </div>
            
                            <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                                <NavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('search.index')" :active="route().current('search.index') || route().current('search.apply.index')">
                                    検索
                                </NavLink>
                                <NavLink v-else :href="route('foreign.search.index')" :active="route().current('foreign.search.index') || route().current('foreign.search.apply') || route().current('foreign.search.apply.index')" >
                                    Search
                                </NavLink>
                            </div>
                            
                            <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                                <NavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('application.index')" :active="route().current('application.index')">
                                    申請リスト
                                </NavLink>
                                <NavLink v-else :href="route('foreign.application.index')" :active="route().current('foreign.application.index')">
                                    ApplicationsList
                                </NavLink>
                            </div>
                            
                            <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                                <NavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('chat.index')" :active="route().current('chat.index') || route().current('chat.show')">
                                    チャット
                                </NavLink>
                                <NavLink v-else :href="route('foreign.chat.index')" :active="route().current('foreign.chat.index') || route().current('foreign.chat.show')">
                                    Chat
                                </NavLink>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative space-x-8 lg:-my-px lg:ml-10 lg:flex">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-lg">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-[#006f89] hover:bg-[#6ba3b0ff] focus:outline-none focus:bg-[#6ba3b0ff] transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!--<DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>-->
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            <span v-if="$page.props.auth.user.is_japanese==1">ログアウト</span>
                                            <span v-else>Logout</span>
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center lg:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:bg-[#f8f9f9ff] transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="#006f89" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="lg:hidden bg-[#fffcf7ff] py-2 mt-2"
                >
                    <div class="py-2 space-y-1">
                        <ResponsiveNavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('mypage')" :active="route().current('mypage') || route().current('profile.edit')">
                            マイページ
                        </ResponsiveNavLink>
                        <ResponsiveNavLink v-else :href="route('foreign.mypage')" :active="route().current('foreign.mypage') || route().current('foreign.profile.edit')">
                            Mypage
                        </ResponsiveNavLink>
                    </div>
                    <div class="py-2 space-y-1">
                        <ResponsiveNavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('search.index')" :active="route().current('search.index') || route().current('search.apply.index')">
                            検索
                        </ResponsiveNavLink>
                        <ResponsiveNavLink v-else :href="route('foreign.search.index')" :active="route().current('foreign.search.index') || route().current('foreign.search.apply.index')">
                            Search
                        </ResponsiveNavLink>
                    </div>
                    <div class="py-2 space-y-1">
                        <ResponsiveNavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('application.index')" :active="route().current('application.index')">
                            申請リスト
                        </ResponsiveNavLink>
                        <ResponsiveNavLink v-else :href="route('foreign.application.index')" :active="route().current('foreign.application.index')">
                            ApplicationsList
                        </ResponsiveNavLink>
                    </div>
                    <div class="py-2 space-y-1">
                        <ResponsiveNavLink v-if="$page.props.auth.user.is_japanese==1" :href="route('chat.index')" :active="route().current('chat.index') || route().current('chat.show')">
                            チャット
                        </ResponsiveNavLink>
                        <ResponsiveNavLink v-else :href="route('foreign.chat.index')" :active="route().current('foreign.chat.index') || route().current('foreign.chat.show')">
                            Chat
                        </ResponsiveNavLink>
                    </div>
                    
                    <div class="pt-2 mb-2 mx-auto border-b w-11/12 border-[#55828c] space-y-1" />

                    <!-- Responsive Settings Options -->
                    <div class="py-2 space-y-1">
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            <span v-if="$page.props.auth.user.is_japanese==1">ログアウト</span>
                            <span v-else>Logout</span>
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

