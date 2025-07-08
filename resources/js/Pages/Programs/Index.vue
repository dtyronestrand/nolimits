<script setup lang="ts">
import Default from '../../Layouts/Default.vue';
import WordList from '../../Components/Theme/UI/WordList.vue';
import IconButton from '../../Components/Theme/UI/IconButton.vue';
import {defineAsyncComponent} from 'vue';
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
<Default>

    <h1 class="text-7xl font-bold text-center text-(--color-text-primary) mt-10 mb-10">Our Programs</h1>
    <div v-for="program in props.programs" :key="program.id" class="flex flex-col w-fit mx-auto text-(--color-text-primary)">
         <div class="product-card grid grid-cols-1 md:grid-cols-2 gap-10 py-12 lg:pb-8 lg:pt-10">
    <div
      class="whole-card border border-(--color-accent) rounded-xl w-fit mx-auto justify-center gap-y-4">
      <div class="w-full flex flex-col justify-between gap-y-5 max-w-[20rem] mx-auto p-5 rounded-xl">
      <div v-if="program.blocks && program.blocks.length > 0" class="flex flex-col gap-y-4">
        <div v-for="block in program.blocks" :key="block.id" class="flex flex-col gap-y-2">
         <img v-if="block.type === 'common-image'" :src="block.medias.common_image.desktop.src"></img>
       </div>
      </div>
        <div class="flex flex-col gap-y-2">
          <h2 class="text-2xl font-bold text-[var(--color-text-primary)] lg:text-left">{{program.title}}
          </h2>
          <p class="text-[var(--color-text-primary)] text-sm lg:text-left">{{program.tagline}}</p>
        <IconButton  href="/programs/{{program.slug}}" class="mt-4 mb-2 p-2 bg-(--color-accent-500) text-base-900 hover:text-(--color-accent-500) hover:border-4 hover:border-(--color-accent-500) rounded-lg">Explore Program</IconButton>
        </div>
      </div>
    </div>
    </div>
    </div>
    </Default>
</template>
<style scoped>
.whole-card {
    background-color: rgba(from var(--color-primary-800) R G B /0.3);
    box-shadow:  rgba(from var(--color-secondary-800) r g b / 0.5) -20px -20px 45px inset,
    rgba(from var(--color-secondary-800) r g b / 0.5) 10px 10px 20px, rgba(from var(--color-secondary-800) r g b / 0.5) 5px 5px 10px;
  
}
</style>