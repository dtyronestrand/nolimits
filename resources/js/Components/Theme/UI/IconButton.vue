<template>
    <!--
      Heads up! 👋
    
      This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
    -->

    <a
        class="group flex items-center justify-between gap-4 rounded-lg border border-[var(--color-primary-base)] bg-[var(--color-primary-base)] px-5 py-3 transition-colors hover:border-3 hover:border-(--color-secondary-base) hover:bg-transparent focus:ring-3"
        :href="href"
    >
        <span
            class="font-bold text-[var(--color-text-dark)] group-hover:text-[var(--color-text-primary) text-xl transition-colors group-hover:text-[var(--color-text-primary)]"
        >
            <slot />
        </span>

        <span
            class="shrink-0 rounded-full border-2 border-current bg-[var(--color-primary-30)] p-2 text-[var(--color-text-dark)] group-hover:bg-transparent group-hover:border-[var(--color-secondary-base)] group-hover:text-[var(--color-tertiary-500)] transition-colors"
        >
            <svg
                class="size-5 shadow-xs rtl:rotate-180"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                />
            </svg>
        </span>
    </a>
</template>
<script setup lang="ts">
const props = defineProps<{ href: string }>();
</script>
