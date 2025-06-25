<script setup lang="ts">
import {defineAsyncComponent} from 'vue';

defineOptions({
    name: 'BlockCommonCards',
});

interface Props {
    block: Model.Block & PropsBlock
}

type PropsBlock = {
    content: {
        heading?: string;
    }
    childs: PropsChildBlock[] // Changed to an array of PropsChildBlock

}

type PropsChildBlock = {
    content: {
        title?: string;
        details?: string;
    }
    medias: {
        image?: Model.MediaWithRoles | null // Made image optional to prevent errors if not present
    }
    id?: string | number; // Optional: if childs have unique IDs for keys
}
const props = defineProps<Props>();
</script>
<template>
    <div v-if="block.content.type === 'profile'">
               <h1 v-if="block.content?.heading" class="text-7xl font-bold text-center text-(--color-text-primary) mb-10">{{ block.content.heading }}</h1>
        <div class="flex  flex-col md;flex-row justify-evenly gap-8 items-center "> <!-- Assuming this container was intended -->
 
            <!-- Loop through each child to create a card -->
            <div
                v-if="block.childs && block.childs.length > 0"
                class="profile w-1/2 shadow-xl rounded-2xl  border-2 border-(--color-accent) text-(--color-text-primary) mb-10" 
                v-for="(child, index) in block.childs" 
                :key="child.id || child.content?.title || index" 
            >
                <div class="flex gap-11 items-center">
                    <!-- Image for the current child -->
                    <img 
                        v-if="child.medias?.image?.desktop?.src"
                        :src="child.medias.image.desktop.src" 
                        :alt="child.content?.title || 'Card Image'" 
                        class="rounded-2xl"
                    >
                    <!-- Content for the current child -->
                    <div>
                        <h2 v-if="child.content?.title" class="font-extrabold text-3xl">{{ child.content.title }}</h2>
                        <p v-if="child.content?.details" class="font-semibold text-sm">{{ child.content.details }}</p>
                    </div>
                </div>
            </div>
            <div v-else-if="!block.childs || block.childs.length === 0" class="text-center text-gray-500">
                 <p>No cards to display.</p>
            </div>
        </div>
    </div>
    <div v-else-if="block.content.type === 'scroll'">
    <
    </div>
</template>
<style scoped>
.profile {
    background-color: rgba(from var(--color-primary-500) R G B / 0.7);
    backdrop-filter: blur(10px);
}
</style>