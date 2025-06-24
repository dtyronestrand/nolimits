<script setup lang="ts">
import { themeChange } from "theme-change";
import { onMounted } from "vue";

onMounted(() => {
    themeChange(false);
});
</script>
<template>
<slot/>
</template>
