<script setup>
import SectionTitle from "./SectionTitle.vue";
</script>

<template>
    <div
        class="md:grid md:grid-cols-3 text-[var(--color-text-primary)] md:gap-6"
    >
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div
                class="px-4 py-5 sm:p-6 bg-[var(--color-surface-base)] border-2 border-[var(--color-primary-base)] shadow-sm sm:rounded-lg"
            >
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
