<template>
 <Default>
                <div class="app max-w-[95vw] h-[100vh] mt-30 mx-auto flex overflow-hidden relative w-full rounded-[14px] backdrop-blur-[20px]">
                <aside class="basis-[240px] border-r-1 border-[var(--color-accent)] p-[26px] overflow-auto shrink-0 max-[945px]:hidden">
                 <div class="mt-[20px] flex flex-col justify-center title rounded-2xl w-full">
                 <h1 class="mb-[14px] text-center p-5">No Limits Martial Arts and Fitness</h1>

   <ul class="mt-10">
   <li class="mb-2">
   <NavLink href="/programs/taekwondo" :active="isLinkActive('/programs/taekwondo')" >Dashboard</NavLink>
   </li>
    <li class="mb-4">
   <NavLink href="/programs/taekwondo/videos" >Videos</NavLink>
</li>
<li class="mb-4">

     <p class="block py-2 pl-3 pr-4 rounded-sm md:flex md:bg-transparent bg-(--color-primary-600) md:p-0 text-(--color-text-primary) transition hover:text-(--color-secondary-500)">
                                        Resources
                                    </p>
                                        <ul class="ml-5">
                                        <li>
                                            <NavLink
                                                :active="isLinkActive('/programs/taekwondo/resources/term')"
                                                href="/programs/taekwondo/resources/terms"
                                                >Basic Korean Terms</NavLink>
                                        </li>
                                    </ul>
  </li>
<li class="mb-4">
    <NavLink href="/programs/taekwondo/schedule" >Schedule</NavLink>
   </li>
   </ul>
                </div>
                </aside>
                <main class="w-full flex-1 overflow-auto">
                    <slot/>
                </main>
                </div>
                </Default>

</template>
<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
import Default from "@/Layouts/Default.vue";
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

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
<style scoped>
aside {
        background-color: rgba(from var(--color-primary-800) R G B / 0.5);
    backdrop-filter: blur(10px) saturate(100%);
    -webkit-backdrop-filter: blur(10px);
}
</style>