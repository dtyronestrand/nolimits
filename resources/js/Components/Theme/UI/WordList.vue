<script setup lang="ts">
import {computed, ref, onMounted, onUnmounted} from 'vue';
import {Icon} from '@iconify/vue';
const props = withDefaults(
    defineProps<{
        words: string[];
        updateInterval?: number;
        numWordsPerRow?: number;
    }>(),
    {
        updateInterval: 5000,
        numWordsPerRow: 15,
    },
 
);
const highlightedWord = ref<Record<number, number>>({});
let intervalId: number | null = null;
function getRandomInt(max: number) {
    return Math.floor(Math.random() * max);
  }
  let colors = [
    "oklch(45.24% 0.18 303.83deg)",
    "oklch(37.81% 0.18 300.41deg)",
    "oklch(33.29% 0.16 297.8deg)",
    "oklch(83.55% 0.15 82.82deg)",
    "oklch(79.12% 0.16 74.82deg)",
    "oklch(75.04% 0.17 65.81deg)",
    "oklch(95.17% 0.13 102.86deg)",
    "oklch(94.06% 0.15 102.23deg)",
    "oklch(93.02% 0.17 101.62deg)",
  ];
const updateHighlights = ()=>{
    const newWord: Record<number, number> = {};
    props.words.forEach((_, rowIndex)=>{
        let newIndex;
        const currentIndex = highlightedWord.value[rowIndex];
        const maxIndex = props.numWordsPerRow;
        if(maxIndex <= 1){
            newIndex = 0;
        } else {
            do {
                newIndex = getRandomInt(maxIndex);
            } while (newIndex === currentIndex);
        }
        newWord[rowIndex] = newIndex;
    });
    highlightedWord.value = newWord;
    };
const getWordColor = (rowIndex: number, wordIndex: number): string => {
    if (highlightedWord.value[rowIndex] === wordIndex) {
        return colors[getRandomInt(colors.length)];
    }
    return 'inherit';
};
onMounted(() => {
    updateHighlights();
    intervalId = window.setInterval(updateHighlights, props.updateInterval);
});
onUnmounted(() => {
    if (intervalId !== null) {
        clearInterval(intervalId);
    }
});
</script>
<template>
    <section
        class="fixed inset-0 top-30 -z-30 h-vh overflow-hidden rounded bg-transparent"
        aria-hidden="true"
        > <!-- Added aria-hidden as it's decorative -->
        <!-- Iterate through each word to create a row -->
        <div
            v-for="(word, rowIndex) in words"
            :key="`row-${rowIndex}`"
            class="word-row mb-8 flex items-center justify-center gap-4 text-surface-600 whitespace-nowrap"
            > <!-- Added whitespace-nowrap to prevent wrapping within the row -->
            <!-- Repeat the word and icon within the row -->
            <template v-for="wordIndex in Array.from({ length: numWordsPerRow }, (_, i) => i)" :key="`word-${rowIndex}-${wordIndex}`">
                <span
                    class="word-itself text-8xl font-extrabold tracking-tighter transition-colors duration-1000 ease-in-out"
                    :style="{ color: getWordColor(rowIndex, wordIndex) }"
                    > <!-- Added transition classes -->
                    {{ word }}
                </span>
                <!-- Show icon between words, but not after the last one -->
                <span v-if="wordIndex < numWordsPerRow - 1" class="text-4xl text-center shrink-0"> <!-- Added shrink-0 to prevent icon shrinking -->
                    <!-- Use a more descriptive name if possible, or ensure 'mingcute:fire-fill' is available -->
                    <Icon class="text-primary-500 "icon="mingcute:fire-fill" />
                </span>
            </template>
        </div>
    </section>
</template>