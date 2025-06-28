<template>
<div class="max-w-screen-xl align center mx-auto p-4">
<h1 class="text-[var(--color-text-primary)] text-5xl font-extrabold mb-8 text-center">{{ block.content.heading }}</h1>
<span class="text-[var(--color-text-primary)] text-3xl">{{ block.content.subheading }}</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 mt-10 md:gap-x-8">
  <div> <!-- This div is the first grid column for the image -->
    <img 
      v-if="block.medias.image" 
      :src="block.medias.image.default.src" 
      alt="Feature Image" 
      class="w-full h-auto object-contain max-h-[500px] rounded-lg">
    <!-- Consider adding a placeholder here if block.medias.image can be null and you want to maintain space -->
    <!-- Example: <div v-else class="w-full h-[500px] bg-gray-200 rounded-lg"></div> -->
  </div>
  <div id="features" class="flex flex-col justify-between ">
    <div v-for="(feature, index) in features" :key="index" class="-ml-20 features mr-20 bg-[]" > <!-- Added p-4 for internal spacing -->
      <h2 id="school" class="text-2xl text-[var(--color-text-primary)] text-left font-semibold mb-8 ">{{ feature.content.heading }}</h2>
      <p class="text-[var(--color-text-primary)] text-left text-xl px-4 pb-6">{{ feature.content.details }}</p>
    </div>
  </div>
  <div class="flex flex-row flex-wrap justify-evenly items-center text-[var(--color-text-primary)] mt-20 md:col-span-2">
    <div v-for="(button, index) in buttons" :key="index" class="buttons p-4 bg-[var(--color-accent-500)] text-[var(--color-neutral-900)] font-bold rounded-xl">
      <Link :href="button.content.button_link">{{ button.content.button_text }}</Link>
    </div>
  </div>
</div>

</template>
<script setup lang="ts">
import {ref, computed} from 'vue';
import {Link} from '@inertiajs/vue3';
defineOptions({
    name: 'BlockCommonFeature',
})
interface Props {
    block: Model.Block & PropsBlock
}
type PropsBlock = {
    content: {
        heading?: string | null
        subheading?: string | null
    }
    medias: {
        image?: Model.Media | Model.MediaWithRoles | null
    }
    childs: propsChilds[]
}
type propsChilds = {
    type: string; // Added type property for filtering
    content: {
        heading?: string | null
        details?: string | null
    }
}
const props = defineProps<Props>();

const features = computed(() => {
    return props.block.childs?.filter((child) => child.type === 'dynamic-repeater-features') || [];
});
const  buttons = computed(() => {
    return props.block.childs?.filter((child) => child.type === 'dynamic-repeater-button_bar') || [];
});
</script>
<style scoped>
#features {
    flex: 1 1 0px;
    min-width: 0;
}
.features {
    background-color: rgba(from var(--color-primary-800) r g b/0.5);
    backdrop-filter: blur(10px);
    box-shadow:  0 4px 30px rgba(from var(--color-accent) r g b/0.3);
    padding: 2.5rem;
    border-radius: 1.5rem;
    border: 2px solid var(--color-accent);
}
.buttons {
    min-width: 15rem;
}
</style>