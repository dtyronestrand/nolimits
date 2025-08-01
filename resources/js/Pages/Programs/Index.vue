<script setup lang="ts">
import Default from '../../Layouts/Default.vue';
import WordList from '../../Components/Theme/UI/WordList.vue';
import IconButton from '../../Components/Theme/UI/IconButton.vue';
import {defineAsyncComponent} from 'vue';
defineOptions({
  layout: Default,  
})
interface Props{
    programs: Model.Program[]
}
const words = [
  "joy",
  "happiness",
  "success",
  "challenge",
  "move",
  "change",
  "grow",
  "experience",
  "self",
  "journey",
  "sustainable"]
const props = defineProps<Props>();
const BlockCommonImage = defineAsyncComponent(() => import('../../Components/Theme/Block/Common/Image.vue'));
</script>
<template>

<div class="w-full h-[100vh]">
    <h1 class="text-7xl font-bold text-center text-(--color-text-primary) pt-10 mb-20">Our Programs</h1>
    <div v-for="program in props.programs" :key="program.id" class=" text-(--color-text-primary)">
    
    <div
      class="whole-card border border-[var(--color-secondary-base)] rounded-xl w-fit mx-auto justify-center gap-y-4">
      <div v-if="program.blocks && program.blocks.length > 0" class="flex flex-col gap-y-4">
        <div v-for="block in program.blocks" :key="block.id" class="flex justify-center">
         <div v-if="block.type === 'common-image'" :style="`background-image: url(${block.medias.common_image.desktop.src}); width: 128px; height: 128px; border-radius: 50%; background-size: cover; background-position: center; overflow: hidden; aspect-ratio: 1/1; display: block;`"></div>
       </div>
      </div>
      <div class="w-full flex flex-col justify-between gap-y-5 max-w-[20rem] mx-auto p-5 rounded-xl">
        <div class="flex flex-col gap-y-2">
          <h2 class="text-[2rem] font-bold text-[var(--color-text-primary)] lg:text-left">{{program.title}}
          </h2>
          <p class="text-[var(--color-text-primary)] text-[1.2rem] lg:text-left">{{program.tagline}}</p>
        <IconButton  href="/programs/{{program.slug}}" class="mt-4 mb-2 p-2 bg-(--color-primary-base) text-[var(--color-text-dark)] hover:text-(--color-primary-base) hover:border-4 hover:border-(--color-secondary-base) rounded-lg">Explore Program</IconButton>
        </div>
     
    </div>
    </div>
    </div>

</div>
</template>
<style scoped>
.whole-card {
    background-color: rgba(from var(--color-surface-70) R G B /0.7);
    
  
}
</style>