<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-(--color-accent) border border-(--color-tertiary-500) rounded-md font-semibold text-xs text-neutral-900 uppercase tracking-widest shadow-xs hover:bg-transparent hover:text-(--color-text-primary) focus:bg-transparent] focus:outline-hidden focus:ring-2 focus:ring-(--color-tertiary-500) focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
