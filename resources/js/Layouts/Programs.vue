<template>
    <div class="relative min-h-screen">
        <div class="pb-10">
            <!-- Added z-20 to ensure header is above other content, including the main area and any fixed backgrounds -->
            <header
                class="sticky z-20 top-0 left-0 w-screen bg-(--color-primary-500) border-b border-(--color-tertiary-500)"
            >
                <nav
                    class="max-w-(--breakpoint-xl) flex flex-wrap items-center justify-between mx-auto p-4"
                >
                    <!-- Logo -->
                    <NavLink href="/" class="flex items-center">
                        <span
                            class="self-center text-xl font-semibold whitespace-nowrap text-(--color-tertiary-500)"
                            >NLMAF</span
                        >
                    </NavLink>

                    <!-- Right-aligned items group (Download, Login/Logout, Mobile Hamburger) --
        <div class="flex items-center md:order-2">
            <div class="hidden m-2 mr-4 sm:inline-block"> <!-- This span's purpose is unclear, might be for spacing or a placeholder -->

                    <div
                        v-if="$page.props.auth.user"
                        class="md:order-2 ml-2 sm:mr-2"
                    >
                        <!-- Adjusted margins for consistency --><span
                            class="mr-2 text-lg text-(--color-text-primary)"
                            ><a href="/user/profile">{{
                                $page.props.auth.user.name
                            }}</a></span
                        >
                           <button
                        type="button"
                        @click="toggleMobileMenu"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-md md:hidden hover:bg-gray-100 focus:outline-hidden focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        :aria-expanded="isMobileMenuOpen.toString()"
                        aria-controls="main-menu-content"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            v-if="!isMobileMenuOpen"
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <svg
                            v-if="isMobileMenuOpen"
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                    <!-- The md:hidden hamburger button was here, it's removed as it seems redundant -->
 
                    <!-- Collapsible Menu Links -->
                    <div
                        id="main-menu-content"
                        :class="{
                            block: isMobileMenuOpen,
                            hidden: !isMobileMenuOpen,
                        }"
                        class="items-center justify-between w-full md:flex md:w-auto md:order-1"
                    >
                        <ul
                            class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0"
                        >
                            <li
                                v-for="link in $page.props.navigations"
                                :class="
                                    link.submenu !== null ? 'has-dropdown' : ''
                                "
                                :key="link.id"
                            >
                                <NavLink
                                    v-if="!link.submenu"
                                    :href="link.url"
                                    :active="isLinkActive(link.url)"
                                    class="block py-2 pl-3 pr-4 rounded-sm md:bg-transparent bg-(--color-primary-600) md:p-0 text-(--color-text-primary) transition hover:text-(--color-secondary-500)"
                                    aria-current="page"
                                    >{{ link.title }}</NavLink
                                >
                                <span v-else>
                                    <NavLink
                                        :href="link.url"
                                        :active="isParentLinkActive(link.url)"
                                        class="block py-2 pl-3 pr-4 rounded-sm md:flex md:bg-transparent bg-(--color-primary-600) md:p-0 text-(--color-text-primary) transition hover:text-(--color-secondary-500)"
                                    >
                                        {{ link.title }}
                                        <svg
                                            class="icon chevron-icon"
                                            viewBox="0 0 24 24"
                                            width="14"
                                            height="14"
                                        >
                                            <path
                                                d="M7 10l5 5 5-5z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </NavLink>
                                    <ul class="dropdown">
                                        <li
                                            v-for="sub in link.submenu"
                                            :key="sub.id"
                                        >
                                            <NavLink
                                                :active="isLinkActive(sub.url)"
                                                :href="sub.url"
                                                >{{ sub.title }}</NavLink
                                            >
                                        </li>
                                    </ul>
                                </span>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            </div>
            </div>
</template>
<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
import { computed, ref } from "vue";

const getCurrentPath = computed(() => {
    return page.url.split("?")[0];
});

const isLinkActive = (linkUrl) => {
    const currentPathValue = getCurrentPath.value;
    if (linkUrl === "/") {
        return currentPathValue === "/";
    }
    return currentPathValue === linkUrl;
};
const isParentLinkActive = (parentUrl, submenu = []) => {
    const currentPathValue = getCurrentPath.value;
    if (
        parentUrl !== "/" &&
        (currentPathValue === parentUrl ||
            currentPathValue.startsWith(parentUrl + "/"))
    ) {
        return true; // Parent link is active
    }
    return submenu.some((sub) => sub.url === currentPathValue);
};

// Reactive state for mobile menu visibility
const isMobileMenuOpen = ref(false); // Initially closed

// Method to toggle the menu state
const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>