<template>
   <div>
        <div class=" mx-auto pb-5">
            <slot name="logo" />
        </div>

        <div class="main-form mx-auto">
            <slot />
        </div>
   </div>

</template>

<style scoped>
.main-form {
    background-color: rgba(from var(--color-surface-70) R G B / 0.7);
    backdrop-filter: blur(10px);
    color: var(--color-neutral-100);
    border: 2px solid var(--color-secondary-base);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    padding: 1.5rem;
width:100%;
}
</style>
