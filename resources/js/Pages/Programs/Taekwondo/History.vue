<template>
    <h1 class="text-7xl text-center mt-8 mb-4 pt-10">History of Taekwondo</h1>
    <div class="grid grid-cols-4 gap-4 pb-10">
    <TKDNav/>
    <section class="col-span-3 p-10 bg-[var(--color-surface-70)] mr-10 rounded-lg">
    <p>Taekwondo is roughly five thousand years old. Native to the country Korea, Taekwondo, as well as many other forms of martial arts came from a combination of fighting skills that were used by people to obtain food and defend themselves against other people and animals. Martial Arts has existed for uncountable years being used for basic survival.</p>
    <p>Taekwondo, in particular, has been explained in somewhat of a children’s story. In the mountains of Korea, there was a colony of monks, or holy men, who spent their days and nights praying and growing food. At the base of the mountains was a town of greedy common people who spent their days and nights lavishing in all fruits of their little labor and small efforts. As winter approached, the people would run out of food and supplies due to their greed and waste would trek up the mountain to raid the home of the monks. The people would steal the food and supplies of the monks, leaving the holy men virtually nothing with which to survive the winter months.</p>
    <p>	After years of this abuse, the monks got together to try and think of a way to solve this problem. One monk had an idea that they should watch the animals and see how they defended themselves from bullies and predators. After watching the animals and copying their movements, the monks decided to use the same motions as the animals to defend their home and food. </p>
    <p>The next time the villagers came, they found an unhappy party of monks who were able to defend themselves and save their food. Thus, Taekwondo was born.</p>
    <p>For a more historical look, one Taekwondo handbook states, “The earliest records of Taekwondo date[s] back to about 50 B.C. During this time, Korea was divided into three kingdoms; Silla, which was founded on the Kyongju plain in 57 B.C.; Koguryo, founded in the Yalu River Valley in 37 B.C.; and Baekche, founded in the southwestern area of the Korean peninsula in 18 B.C. Evidence of the practice of Taek-Kyon (the earliest form of Taekwondo) has been found in paintings on the ceiling of the Muyong-chong, a royal tomb from the Koguryo dynasty.”</p>
    <p>After 36 years of Japanese rule, Korea was liberated in 1945. Taekwondo is practiced in 209 countries by over 80 million people. It is thought of as the most popular Martial Art in the world and became an official Olympic sport in 2000.</p>
    </section>
    </div>
</template>
<style scoped>

    p {
        line-height: 1.6;
        margin-bottom: 15px;
        padding-left: 2rem;
        @apply text-balance;
        font-size: 1.5rem;
    }
    section{
    background: var(--color-surface-70);
}
    </style>
<script setup lang="ts">
import Default from "@/Layouts/Default.vue";
import TKDNav from "@/Components/TKDNav.vue";
defineOptions({
    layout: Default,

})

</script>