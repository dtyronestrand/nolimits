<template>
      <section class="flex flex-col items-center pt-16 justify-center">
<h1 class="text-7xl font-bold text-[var(--color-text-primary)] mb-4">Basic Korean Terms</h1>
    </section>
   
   <section class="w-[100%] mt-20  mx-auto">
  <!-- Tab Buttons -->
  <nav class=" p-2 rounded-t-lg">
    <div class="flex justify-center space-x-4">
      <button :class="['px-4 py-2 text-[var(--color-text-primary)] font-semibold border-b-4 border-[var(--color-accent)] hover:text-[var(--color-base-900)] hover:bg-[var(--color-accent)] focus:outline-none tab-button', { active: activeTab === 'tab1' }]" @click="activeTab = 'tab1'">Couting to Ten</button>
      <button :class="['px-4 py-2 text-[var(--color-text-primary)] font-semibold border-b-4 border-[var(--color-accent)] hover:text-[var(--color-base-900)] hover:bg-[var(--color-accent)] focus:outline-none tab-button', { active: activeTab === 'tab2' }]" @click="activeTab = 'tab2'">Basic Classroom Terms</button>
    
    </div>
  </nav>
</section>
  <div v-show="activeTab === 'tab1'" class="p-4 tab-content bg-[var(--color-primary-800)] shadow-md grid grid-cols-5 rounded-lg">
  
<FlipCard v-for="count in counting" :key="count.number" class="m-8 col-span-1">
    <template #default>
        <div class="flex flex-col items-center justify-center h-full card " >
            <h3 class="text-3xl font-bold">{{ count.number }}</h3>
            <p class="text-xl">{{ count.word }}</p>
        </div>
    </template>
    <template #back>
        <div class="flex flex-col items-center card justify-center h-full">
            <h3 class="text-2xl font-bold">{{ count.korean }}</h3>
        
        </div>
    </template>
</FlipCard>
  </div>
  <div v-show="activeTab === 'tab2'" class="p-4 tab-content bg-[var(--color-primary-800)) shadow-md grid grid-cols-5 rounded-lg">
       <FlipCard v-for="term in classroom" :key="term.english" class="m-8 col-span-1">
            <template #default>
                <div class="flex flex-col items-center justify-center h-full card">
                    <h3 class="text-3xl text-center font-bold">{{ term.english }}</h3>
                    </div>
            </template>
            <template #back>
                <div class="flex flex-col items-center justify-center h-full card">
                    <h3 class="text-2xl text-center font-bold">{{ term.korean }}</h3>
                </div>
            </template>
        </FlipCard>
  </div>
   


</template>
<script setup lang="ts">

import FlipCard from '@/Components/Theme/UI/FlipCard.vue';
import Programs from '@/Layouts/Programs.vue';
import { ref } from 'vue';

const activeTab = ref('tab1');

defineOptions({
    layout: Programs
});
let counting = [
    {number: 1, word: "one", korean: "hana"},
    {number: 2, word: "two", korean: "dool"},
    {number: 3, word: "three", korean: "set"},
    {number: 4, word: "four", korean: "net"},   
    {number: 5, word: "five", korean: "dasut"},
    {number: 6, word: "six", korean: "yasut"},
    {number: 7, word: "seven", korean: "elgop"},
    {number: 8, word: "eight", korean: "yudal"},
    {number: 9, word: "nine", korean: "ahop"},
    {number: 10, word: "ten", korean: "yaul"}
];
let classroom = [
  {
    "english": "attention",
    "korean": "chariot"
  },
  {
    "english": "bow to master",
    "korean": "sa bum nim ke kyung yet"
  },
  {
    "english": "bow to senior",
    "korean": "sa bae nim ke kyung yet"
  },
  {
    "english": "ready stance",
    "korean": "joon bee"
  },
  {
    "english": "go back",
    "korean": "goman"
  },
  {
    "english": "rest",
    "korean": "shier"
  },
  {
    "english": "turn around",
    "korean": "duiro dora"
  },
  {
    "english": "switch stance",
    "korean": "kap sai"
  },
  {
    "english": "thank you",
    "korean": "kam sa ham ne da"
  },
  {
    "english": "form or pattern",
    "korean": "hyung"
  },
  {
    "english": "class dismissed",
    "korean": "soo ryun kut"
  },
  {
    "english": "uniform",
    "korean": "dobok"
  },
  {
    "english": "studio",
    "korean": "dojang"
  }
]
</script>
<style scoped>
.card {
    background-color: rgba(from var(--color-primary-800) R G B /0.3);
    backdrop-filter: blur(10px) saturate(150%);
    border: 2px solid rgba(from var(--color-accent-500) R G B /1);
    padding-inline: 1rem;
}
  .tab-button.active {
    background-color: var(--color-primary-800);
    border-color: var(--color-secondary-500);
    color: var(--color-text-primary);
  }

  .tab-content {
    background-color: var(--color-primary-800);
  }
</style>