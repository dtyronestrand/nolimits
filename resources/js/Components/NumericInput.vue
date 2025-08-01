<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: Number,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-[var(--color-secondary-base)] focus:border-[var(--color-primary-base)] focus:ring-i[var(--color-primary-base)] text-[var(--color-text-dark)] rounded-md  text-[1.2rem] shadow-xs"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
