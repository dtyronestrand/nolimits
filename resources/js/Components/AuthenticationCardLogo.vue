<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    class: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <Link :href="'/'">
<img class="rounded-full w-40 mx-auto" src="/assets/images/Z2sbZpbqstJ980jJ_NLMAF_LOGO_2shues_smallcropped.jpeg" :class="props.class" alt="No Limits Martial Arts Foundation Logo" />
    </Link>
</template>
