<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-[var(--color-accent)] border border-[var(--color-accent-500)] rounded-md font-semibold text-xs text-[var(--color-neutral-900)] uppercase tracking-widest shadow-sm hover:bg-transparent hover:text-[var(--color-text-primary)] focus:bg-transparent] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-500)] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
