<template>
    <SecondaryButton>
    <Link :href="href">
        <slot />
    </Link>
    </SecondaryButton>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
const props= defineProps({
    href:String
})
</script>