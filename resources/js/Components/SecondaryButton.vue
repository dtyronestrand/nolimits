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
        class="inline-flex items-center px-4 py-2 bg-[var(--color-primary-base)] border border-[var(--color-secondary-base)] rounded-md font-semibold text-xs text-[var(--color-text-dark)] uppercase tracking-widest shadow-xs hover:bg-transparent hover:text-[var(--color-text-primary)]focus:bg-transparent focus:outline-hidden focus:ring-2 focus:ring-[var(--color-secondary-base)] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
