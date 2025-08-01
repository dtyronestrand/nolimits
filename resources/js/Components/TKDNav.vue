<template>
    <aside class="min-h-screen border border-[var(--color-secondary-base)] ml-10 pl-10 pr-10 col-span-1 bg-[var(--color-surface-90)] p-4 rounded-lg">
<SignUpButton/>
<ul >
<li >
<NavLink class="block text-[1.75rem] mt-10 text-[var(--color-primary)]"href="/programs/taekwondo" >Back to Taekwondo</NavLink>
</li>
<li><NavLink class="block text-[1.75rem] mt-10 text-[var(--color-primary)]" href="/programs/taekwondo/history">History of Taekwondo</NavLink></li>
<li><NavLink class="block text-[1.75rem] mt-10 text-[var(--color-primary)]" href="/programs/taekwondo/about">About Taekwondo</NavLink></li>
<li><NavLInk class="block text-[1.75rem] mt-10 text-[var(--color-primary)]" href="/programs/taekwondo/classes">Our Taekwondo Classes</NavLInk></li>
</ul>

</aside>
</template>
<script setup lang="ts">
import SignUpButton from '@/Components/SignUpButton.vue';
import NavLink from '@/Components/NavLink.vue';
</script>