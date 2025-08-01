<template>
    <div
        v-for="child in block.childs"
        :key="child.content.title"
        :class="[ getBentoSize(child)]"
        class="rounded-xl text-[var(--color-text-primary)]"
    >
 
            <h3 class="p-10 text-5xl font-semibold mb-1">
                {{ child.content.title }} 
            </h3>
            <div
                class="text-[1.2rem] pl-10 pr-20 leading-5 text-[var(--color-text-secondary)] [&_table]:w-full [&_table]:border-2 [&_table]:border-[var(--color-secondary-base)] [&_td]:border-2 [&_td]:border-[var(--color-secondary-base)] [&_th]:border-2 [&_th]:border-[var(--color-secondary-base)] [&_table]:border-collapse [&_p]:p-2"
                v-html="child.content.content"
            ></div>
        </div>
 
</template>
<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
defineOptions({
    name: "BlockCommonBento",
});
function getBentoSize(child: BentoItem) {
    switch (child.content?.size) {
        case "small":
            return "col-span-1 bg-[var(--color-surface-70)]";
        case "medium":
            return "col-span-2 bg-[var(--color-surface-70)]";
        case "large":
            return "col-span-3 bg-[var(--color-surface-70)]";
        default:
            return "col-span-3 bg-[var(--color-surface-70)]";
    }
}
type BentoItem = {
    content: {
        title?: string | null; // Optional title within the content object
        content?: string | null; // The actual HTML content/description
        size?: "small" | "medium" | "large" | null; // Optional size property
    };
    medias: {
        image?: Model.MediaWithRoles | null;
    };
};

interface Props {
    block: {
        childs: BentoItem[]; // block.childs is directly an array of BentoItem
    };
}

defineProps<Props>();
</script>
<style scoped>

</style>