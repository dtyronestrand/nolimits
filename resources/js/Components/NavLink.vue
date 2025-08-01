<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-(--color-accent) text-[1.2rem] font-medium leading-5 text-(--color-text-primary) focus:outline-hidden focus:border-(--color-accent) transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-[1.2rem] font-medium leading-5 text-(--color-text-primary) hover:text-(--color-secondary-500) hover:border-(--color-accent) focus:outline-hidden focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
