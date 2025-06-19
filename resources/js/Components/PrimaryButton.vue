<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center mt-8 px-4 py-2 bg-[var(--color-accent)] border border-transparent rounded-md font-semibold text-xs text-[var(--color-neutral-900)] uppercase tracking-widest hover:bg-transparent focus:bg-transparent hover:border-2 hover:border-[var(--color-accent-500)] active:bg-transparent focus:outline-none focus:ring-2 focus:ring-[var(--color-secondary-500)] focus:ring-offset-2 disabled:opacity-50 hover:text-[var(--color-text-primary)] transition ease-in-out duration-150">
        <slot />
    </button>
</template>
