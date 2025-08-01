<template>
    <aside class="min-h-screen border border-[var(--color-secondary-base)] ml-10 pl-10 pr-10 col-span-1 bg-[var(--color-surface-90)] p-4 rounded-lg">
<h2>No Limits Martial Arts and Fitnes</h2>
<ul >
<li >
<NavLink class="block text-[1.75rem] mt-10 text-[var(--color-primary)]"href="/programs/taekwondo" >My Dashboard </NavLink>
</li>
<li><NavLink class="block text-[1.75rem] mt-10 text-[var(--color-primary)]" href="/programs/taekwondo/history">History of Taekwondo</NavLink></li>
<li><NavLink class="block text-[1.75rem] mt-10 text-[var(--color-primary)]" href="/programs/taekwondo/about">Terminology</NavLink></li>

</ul>

</aside>
</template>
<script setup lang="ts">

import NavLink from '@/Components/NavLink.vue';
</script>