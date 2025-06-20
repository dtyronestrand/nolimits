<template>
    <!--
      Heads up! 👋
    
      This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
    -->
    
    <a
      class="group flex items-center justify-between gap-4 rounded-lg border border-(--color-accent) bg-(--color-accent) px-5 py-3 transition-colors hover:border-3 hover:border-(--color-accent-500) hover:bg-transparent focus:ring-3 "
      :href="href"
    >
      <span class="font-bold text-(--color-inverse-text) text-xl transition-colors group-hover:text-(--color-text-primary)">
<slot/>
      </span>
    
      <span class="shrink-0 rounded-full border-2 border-current bg-(--color-accent-300) p-2 text-(--color-text-inverse) group-hover:bg-transparent group-hover:border-(--color-accent-500)  group-hover:text-(--color-accent-500) transition-colors">
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