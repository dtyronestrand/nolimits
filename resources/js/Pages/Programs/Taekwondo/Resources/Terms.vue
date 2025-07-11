<template>
    <Programs>
    <h1 class="text-center text-7xl">Basic Korean Terms</h1>
    <section class="ml-10">
 <h2 class="mt-20 text-5xl mb-20">Counting to Ten</h2>
 
<div class="grid grid-cols-5 gap-8 place-content-center">
<FlipCard v-for="count in counting" :key="count.number" class="m-2 ">
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
    </section>
    <section class="ml-10">
    <h2 class="mt-20 text-5xl mb-20">Classroom Terms</h2>
    <div class="grid grid-cols-4 gap-8 place-content-center">
        <FlipCard v-for="term in classroom" :key="term.english" class="m-2">
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
    </section>
    </Programs>
</template>
<script setup lang="ts">

import FlipCard from '@/Components/Theme/UI/FlipCard.vue';
import Programs from '@/Layouts/Programs.vue';

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
</style>