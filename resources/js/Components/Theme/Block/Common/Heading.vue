<template>
<component v-if="block.content.heading" :is="headingTag" class="mt-12 text-balance text-center text-5xl md:text-7xl text-[var(--color-text-primary)]" v-html="goldText(block.content.heading)">

</component>
</template>
<script setup lang="ts">
import {computed} from 'vue';
defineOptions({
    name: 'BlockCommonHeading',
})

interface Props {
    block: Model.Block & PropsBlock
}

type PropsBlock = {
    content: {
        heading?: string | null
        level?: string | null
    }
}

const props = defineProps<Props>();
    const validHeadingLevels: ReadonlyArray<string> = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
const headingTag = computed(()=>{
    const level = props.block.content.level;
    if (level && validHeadingLevels.includes(level)){
        return level;
    }
    return h2;
});
function goldText(sentence: string) {

  const words = sentence.split(' ')
  if (words.length <= 2) {
    return sentence
  } else{
  const lastTwo = words.slice(-2).join(' ')
  const remaining = words.slice(0, -2).join(' ')
  return `${remaining} <span class="bg-gradient-to-b from-yellow-200 to-yellow-500 bg-clip-text not-italic text-transparent">${lastTwo}</span>`
  }
}
</script>