<template>
    <div class="relative min-h-screen">
   <div class="pb-10">
   <!-- Added z-20 to ensure header is above other content, including the main area and any fixed backgrounds -->
     <header class=" sticky z-20 top-0 left-0 w-screen bg-(--color-primary-800) border-b border-(--color-accent-500) ">
    <nav class="max-w-(--breakpoint-xl) flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <NavLink href="/" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap text-(--color-accent-500)">NLMAF</span>
         
        </NavLink>

        <!-- Right-aligned items group (Download, Login/Logout, Mobile Hamburger) --
        <div class="flex items-center md:order-2">
            <div class="hidden m-2 mr-4 sm:inline-block"> <!-- This span's purpose is unclear, might be for spacing or a placeholder -->
       
 
         
            
            <div v-if="$page.props.auth.user" class="md:order-2 ml-2 sm:mr-2"> <!-- Adjusted margins for consistency --><span class="mr-2 text-lg text-(--color-text-primary)"><a href="/user/profile" >{{ $page.props.auth.user.name }}</a></span>
                <SecondaryButton @click="handleLogout">Logout</SecondaryButton>
            </div>
            <div v-else class="md:order-2 ml-2 sm:mr-2"> <!-- Adjusted margins for consistency -->
                <SecondaryButton @click="handleLogin">Login</SecondaryButton>
            </div>

            <!-- Mobile Menu Hamburger Button -->
          <button type="button"
    @click="toggleMobileMenu"
    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-md md:hidden hover:bg-gray-100 focus:outline-hidden focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    :aria-expanded="isMobileMenuOpen.toString()"
    aria-controls="main-menu-content">
                <span class="sr-only">Open main menu</span>
                <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg  v-if="isMobileMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <!-- The md:hidden hamburger button was here, it's removed as it seems redundant -->
      

        <!-- Collapsible Menu Links -->
<div id="main-menu-content"
     :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }"
     class="items-center justify-between w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">
                <li v-for="link in $page.props.navigations" :class="link.submenu !== null ? 'has-dropdown' : ''" :key="link.id">
                    <NavLink v-if="!link.submenu" :href="link.url"
                       :active="isLinkActive(link.url)" class="block py-2 pl-3 pr-4 rounded-sm md:bg-transparent bg-(--color-primary-600) md:p-0 text-(--color-text-primary) transition hover:text-(--color-secondary-500)"
                        aria-current="page">{{ link.title }}</NavLink>
                    <span v-else>
                        <NavLink :href="link.url"
                            :active="isParentLinkActive(link.url)"
                            class=" block py-2 pl-3 pr-4 rounded-sm md:flex md:bg-transparent bg-(--color-primary-600) md:p-0 text-(--color-text-primary) transition hover:text-(--color-secondary-500)">
                        {{ link.title }} <svg class="icon chevron-icon" viewBox="0 0 24 24" width="14" height="14">
                            <path d="M7 10l5 5 5-5z" fill="currentColor"></path>
                        </svg>
                        </NavLink>
                        <ul class="dropdown">
                            <li v-for="sub in link.submenu" :key="sub.id">
                                <NavLink  :active="isLinkActive(sub.url)" :href="sub.url">{{ sub.title }}</NavLink>
                            </li>
                        </ul>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
   </header>
    <!-- Added z-0 and a background color.
         z-0 ensures this main content area is above any z-index: -1 elements (like the homepage canvas)
         and correctly positioned below the z-20 header.
         IMPORTANT: Replace 'bg-white dark:bg-neutral-800' with your site's actual page background color classes or variables. -->
    <main class="gradient grow flex flex-col"> <!-- Allow main to grow and be a flex container for its slot -->
        <slot></slot>
     
    </main>
 <footer class="bg-(--color-primary-800) border-t border-(--color-accent) mt-auto absolute bottom-0 h-10">
 <div class=" lg:grid lg:grid-cols-8 bg-(--color-primary-800)">
    <div class="relative ml-10 block lg:col-span-3">
        <img src="/assets/images/Z2sbZpbqstJ980jJ_NLMAF_LOGO_2shues_smallcropped.jpeg" 
             alt="No Limits Martial Arts and Fitness" 
          class="relative ml-10 mt-4 mb-8 aspect-auto h-auto w-1/4 rounded-full object-cover">
        <p class="mt-8 text-xs text-(--color-text-primary) sm:mt-0">
            &copy; 2025. No Limits Martial Arts and Fitness. All rights reserved.
          </p>
  
      </div>
    <!-- Content Section -->
   <div class="px-4 py-10 sm:px-6 lg:col-span-2 lg:px-8">
      <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
        <div>
          <p>
     <span class="text-xl tracking-wide text-(--color-text-primary) uppercase"> Contact Us</span>
    <span class="block text-xl font-medium text-(--color-text-primary)">804-867-5309</span>
    <PrimaryButton >Leave a Message</PrimaryButton>
    </p>
     <ul class="mt-8 text-center flex gap-6">
            <li>
              <a
                href="#"
                rel="noreferrer"
                target="_blank"
                class="text-(--color-accent) transition hover:opacity-75"
              >
                <span class="sr-only">Facebook</span>
  
                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    fill-rule="evenodd"
                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                    clip-rule="evenodd"
                  />
                </svg>
              </a>
            </li>
  
            <li>
              <a
                href="#"
                rel="noreferrer"
                target="_blank"
                class="text-(--color-accent) transition hover:opacity-75"
              >
                <span class="sr-only">Instagram</span>
  
                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    fill-rule="evenodd"
                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                    clip-rule="evenodd"
                  />
                </svg>
              </a>
            </li>
  
            <li>
              <a
                href="#"
                rel="noreferrer"
                target="_blank"
                class="text-(--color-accent) transition hover:opacity-75"
              >
                <span class="sr-only">Twitter</span>
  
                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                  />
                </svg>
              </a>
            </li>
          </ul>
        </div>
    </div>
    </div>
  <div class="grid grid-cols-3 gap-4 pt-10 sm:grid-cols-2">
          <div>
    <p class="font-medium text-(--color-text-primary)">Navigation</p>
    <ul class="mt-6 space-y-4 text-sm">
    <li v-for="link in $page.props.navigations" :key="link.id">
    <NavLink :href="link.url" class="text-(--color-text-primary) hover:text-(--color-accent)">{{ link.title }}</NavLink>
    </li>
    </ul>
       </div>
         <div>
          <ul class="mt-5 space-y-4 ml-10 text-sm">
            <li>
              <a href="#" class="text-(--color-text-primary)   transition hover:opacity-75"> Terms & Conditions </a>
            </li>
  
            <li>
              <a href="#" class="text-(--color-text-primary)   transition hover:opacity-75"> Privacy Policy </a>
            </li>
  
            <li>
              <a href="#" class="text-(--color-text-primary)   transition hover:opacity-75"> Cookies </a>
            </li>
          </ul>
  
 </div>
      
        </div>
      </div>
    
    
 
    
</footer>
   </div>
      </div>

</template>
<script setup>

import NavLink from "@/Components/NavLink.vue";
import {usePage, router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import IconButton from "@/Components/Theme/UI/IconButton.vue";
defineProps({
    title: String
});

const page = usePage();
const handleLogout = ()=>{
    router.post(route('logout'));
}
const handleLogin  = ()=>{
    router.visit(route('login'))
}

const getCurrentPath = computed(() =>{
    return page.url.split('?')[0];
});

const isLinkActive = (linkUrl)=>{
    const currentPathValue = getCurrentPath.value;
    if (linkUrl === '/'){
        return currentPathValue === '/';
    }
    return currentPathValue === linkUrl
};
const isParentLinkActive = (parentUrl, submenu = []) => {
    const currentPathValue = getCurrentPath.value;
    if (parentUrl !== '/' && (currentPathValue === parentUrl || currentPathValue.startsWith(parentUrl + '/'))) {
        return true; // Parent link is active
    }
    return submenu.some(sub => sub.url === currentPathValue);

};

// Reactive state for mobile menu visibility
const isMobileMenuOpen = ref(false); // Initially closed

// Method to toggle the menu state
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

</script>
<style scoped>

/* Reset some default browser styles */


/* Basic content styling for demo */


/* Header and Navbar */

/* Icons */

.icon {
    transition: var(--transition-medium);
    vertical-align: middle;
}

.chevron-icon {
    transition: transform var(--transition-medium);
}

.has-dropdown:hover .chevron-icon {
    transform: rotate(180deg);
}



/* Dropdown Menus */
.has-dropdown {
    position: relative;
}

.dropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    min-width: 220px;
    background: var(--dropdown-bg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 0.5rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px) scale(0.98);
    transition: all var(--transition-medium);
    box-shadow: 0 10px 30px var(--shadow-color);
    z-index: 100;
}

.has-dropdown:hover .dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown::before {
    content: '';
    position: absolute;
    top: -6px;
    left: 20px;
    width: 12px;
    height: 12px;
    background: var(--dropdown-bg);
    border-left: 1px solid var(--border-color);
    border-top: 1px solid var(--border-color);
    transform: rotate(45deg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
}

.dropdown li {
    list-style: none;
}

.dropdown a {
    color: var(--text-color);
    text-decoration: none;
    padding: 0.7rem 1rem;
    display: block;
    border-radius: var(--border-radius);
    transition: all var(--transition-medium);
    margin-bottom: 2px;
}

.dropdown a:hover {
    background: rgba(244, 208, 63, 0.15);
    color: var(--primary-color);
    transform: translateX(5px);
}

</style>
