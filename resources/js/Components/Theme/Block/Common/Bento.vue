<template>
<div v-for="child in block.childs" :key="child.content.title" :class="[p-6, getBentoSize(child)]" class="text-[var(--color-text-primary)]">
<div class="flex" >
<h3 class="text-lg font-semibold mb-1">{{child.content.title}}</h3>
<div class="text-sm text-[var(--color-text-secondary)]" v-html="child.content.content"></div>
</div>

</div>
</template>
<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import {computed} from 'vue';
defineOptions({
  name: 'BlockCommonBento',
})
function getBentoSize(child: BentoItem) {
    switch (child.content?.size) {
        case 'small':
            return 'col-span-2 row-span-1 bg-[var(--color-primary-800)]';
        case 'medium':
            return 'col-span-3 row-span-2 bg-[var(--color-primary-800)]';
        case 'large':
            return 'col-span-4 row-span-3 bg-[var(--color-primary-800)]';
        default:
            return 'col-span-1 row-span-1 bg-[var(--color-primary-800)]';
    }
}
type BentoItem = {
    content: {
    title?: string | null; // Optional title within the content object
    content?: string | null; // The actual HTML content/description
    size?: 'small' | 'medium' | 'large' | null; // Optional size property
};
  medias: {
  image?: Model.MediaWithRoles | null;
};
}

interface Props {
  block: {
    childs: BentoItem[]; // block.childs is directly an array of BentoItem
  }
}

defineProps<Props>();
</script>
